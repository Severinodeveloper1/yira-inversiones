<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\PageBanner;
use App\Models\Product;
use App\Models\Post;
use App\Models\Claim;
use App\Models\Faq;
use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $banners = Banner::where('is_active', true)->get();
        $categories = Category::all();
        $featuredProducts = Product::where('is_active', true)
            ->where('is_featured', true)
            ->with('category')
            ->take(10)
            ->get();

        $promoProducts = Product::where('is_active', true)
            ->whereNotNull('promo_price')
            ->with('category')
            ->take(8)
            ->get();

        return view('frontend.index', compact('banners', 'categories', 'featuredProducts', 'promoProducts'));
    }

    public function nosotros()
    {
        $pageBanners = PageBanner::forPage('nosotros');
        return view('frontend.nosotros', compact('pageBanners'));
    }

    public function tienda(Request $request)
    {
        $query = Product::where('is_active', true)->with('category');

        // Filter by Category
        if ($request->has('category') && filled($request->category)) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by Line of Business Type (Hogar / Oficina)
        if ($request->has('type') && in_array($request->type, ['hogar', 'oficina'])) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('type', $request->type);
            });
        }

        // Search by Product name or Category name
        if ($request->has('search') && filled($request->search)) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                  ->orWhere('description', 'like', $searchTerm);
            });
        }

        $products   = $query->paginate(12)->withQueryString();
        $categories = Category::all();
        $pageBanners = PageBanner::forPage('tienda');

        return view('frontend.tienda', compact('products', 'categories', 'pageBanners'));
    }

    public function product($slug)
    {
        $product = Product::where('is_active', true)
            ->where('slug', $slug)
            ->with('category')
            ->firstOrFail();

        // Get related products (same category)
        $relatedProducts = Product::where('is_active', true)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('frontend.product', compact('product', 'relatedProducts'));
    }

    public function cart()
    {
        $recommendedProducts = Product::where('is_active', true)
            ->take(4)
            ->get();
        return view('frontend.cart', compact('recommendedProducts'));
    }

    public function blog()
    {
        $posts = Post::where('is_published', true)
            ->where(function($q) {
                $q->whereNull('published_at')
                  ->orWhere('published_at', '<=', now());
            })
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        $pageBanners = PageBanner::forPage('blog');

        return view('frontend.blog', compact('posts', 'pageBanners'));
    }

    public function blogPost($slug)
    {
        $post = Post::where('is_published', true)
            ->where('slug', $slug)
            ->firstOrFail();

        $recentPosts = Post::where('is_published', true)
            ->where('id', '!=', $post->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('frontend.blog_post', compact('post', 'recentPosts'));
    }

    public function contact()
    {
        $faqs = Faq::where('is_active', true)->get();
        $pageBanners = PageBanner::forPage('contacto');
        return view('frontend.contact', compact('faqs', 'pageBanners'));
    }

    public function storeClaim(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'document_type' => 'required|string',
            'document_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'type' => 'required|in:reclamo,queja',
            'description' => 'required|string',
        ]);

        $year = date('Y');
        $count = Claim::whereYear('created_at', $year)->count() + 1;
        $claimNumber = 'REV-' . $year . '-' . str_pad((string) $count, 4, '0', STR_PAD_LEFT);

        $claim = Claim::create([
            'claim_number' => $claimNumber,
            'fullname' => $request->fullname,
            'document_type' => $request->document_type,
            'document_number' => $request->document_number,
            'email' => $request->email,
            'phone' => $request->phone,
            'type' => $request->type,
            'description' => $request->description,
            'status' => 'pendiente',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Su reclamación ha sido registrada con el código: ' . $claimNumber,
            'claim_number' => $claimNumber,
        ]);
    }

    public function storeQuote(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'project' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        \App\Models\Quote::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'project' => $request->project,
            'message' => $request->message,
            'status' => 'pendiente',
        ]);

        return response()->json([
            'success' => true,
            'message' => '¡Cotización recibida con éxito! Nos comunicaremos con usted lo antes posible.',
        ]);
    }

    public function policies()
    {
        $policies = Policy::all()->keyBy('key');
        return view('frontend.policies', compact('policies'));
    }
}
