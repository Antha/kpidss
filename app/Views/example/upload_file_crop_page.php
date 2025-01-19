<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Upload & Crop</title>
    <!-- Cropper.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropperjs@1.5.12/dist/cropper.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .crop-container {
            max-width: 400px;
            margin: auto;
        }
        img {
            max-width: 100%;
        }
        .preview {
            width: 150px;
            height: 150px;
            overflow: hidden;
            border: 1px solid #ddd;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Upload and Crop Image</h2>
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <form id="uploadForm">
                    <div class="mb-3">
                        <label for="photoInput" class="form-label">Choose Image</label>
                        <input type="file" class="form-control" id="photoInput" accept="image/*">
                    </div>
                    <div class="text-center">
                        <img id="image" class="img-fluid" style="display: none; max-height: 300px;">
                    </div>
                    <div class="preview text-center"></div>
                    <div class="text-center mt-3">
                        <button type="button" id="cropButton" class="btn btn-primary" style="display: none;">Crop & Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Cropper.js JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script>
        let cropper;
        const photoInput = document.getElementById('photoInput');
        const image = document.getElementById('image');
        const cropButton = document.getElementById('cropButton');
        const preview = document.querySelector('.preview');

        photoInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    image.src = e.target.result;
                    image.style.display = 'block';
                    if (cropper) {
                        cropper.destroy();
                    }
                    cropper = new Cropper(image, {
                        aspectRatio: 1, // Square crop (1:1)
                        preview: '.preview',
                    });
                    cropButton.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        cropButton.addEventListener('click', () => {
            const croppedCanvas = cropper.getCroppedCanvas({
                width: 200, // Output width
                height: 200, // Output height
            });

            // Convert to Blob for upload
            croppedCanvas.toBlob((blob) => {
                const formData = new FormData();
                formData.append('croppedImage', blob);

                // Upload to server
                fetch('/loyalty/upload_photo/', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    alert('Upload successful!');
                    console.log(data);
                })
                .catch(error => {
                    console.error('Upload failed:', error);
                });
            });
        });
    </script>
</body>
</html>
