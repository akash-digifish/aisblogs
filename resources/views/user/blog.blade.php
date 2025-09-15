<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $blog->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background-color: #f9f9f9;
        }
        .details-section {
            padding: 60px 15px;
            background-color: #fff;
        }
        .heading-1-box h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #333;
        }
        .details-img img {
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .blog-content {
            margin-top: 30px;
            font-size: 1.1rem;
            line-height: 1.8;
            color: #444;
        }
        .heading-5-box {
            margin-top: 60px;
            text-align: center;
        }
        .heading-5-box p {
            font-size: 1.2rem;
            font-weight: 500;
            color: #222;
        }
    </style>
</head>
<body>

<section class="details-section">
    <div class="container-fluid m-3">
        <div class="blog-detail-section">

            {{-- Blog Heading --}}
            <div class="heading-1-box mb-4 text-center">
                <h1>{{ $blog->title }}</h1>
                <h6 class="text-muted">{{ $blog->created_at->format('F d, Y') }}</h6>
            </div>

            {{-- Featured Image --}}
            @if($blog->featured_image)
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="details-img mb-4">
                            <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="img-fluid w-100">
                        </div>
                    </div>
                </div>
            @endif

            {{-- Blog Description --}}
            <div class="blog-content">
                {!! $blog->description !!}
            </div>

            {{-- End Note --}}
            <div class="heading-5-box mt-5">
                <!-- <p><strong>Thanks for reading!</strong></p> -->
            </div>

        </div>
    </div>
</section>

</body>
</html>
