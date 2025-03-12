@php
    use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h3>Welcome to home</h3>
    
    <!-- Debug info
    <div class="alert alert-info">
      <p>Debug info:</p>
      <p>Auth::check() = {{ Auth::check() ? 'true' : 'false' }}</p>
      @if(Auth::check())
          <p>User email: {{ Auth::user()->email }}</p>
      @endif
    </div> -->
    
    <!-- Regular content -->
    

    <!-- Products Listing -->
    <div class="mt-5">
      <h4>Available Products</h4>
      @if(isset($products) && $products->count() > 0)
        <div class="row">
          @foreach($products as $product)
            <div class="col-md-4">
              <div class="card mb-4">
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body">
                  <h5 class="card-title">{{ $product->name }}</h5>
                  <p class="card-text">{{ $product->description }}</p>
                  <p class="card-text"><strong>${{ $product->price }}</strong></p>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <p>No products found.</p>
      @endif
    </div>
    @if(Auth::check())
      <div class="card p-4 mt-3">
          <h4>You are logged in!</h4>
          <p>Your email: {{ Auth::user()->email }}</p>
          <form action="{{ route('logout') }}" method="POST" class="mt-3">
              @csrf
              <button type="submit" class="btn btn-danger">Logout</button>
          </form>
      </div>
    @else
      <div class="card p-4 mt-3">
          <p class="text-danger">You are not logged in.</p>
          <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
      </div>
    @endif
  </div>
</body>
</html>
