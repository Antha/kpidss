<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Upload & Crop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropperjs@1.5.12/dist/cropper.min.css">
    <style>
        .crop-container {
            width: 100%;
            max-width: 400px;
            margin: auto;
        }
        img {
            max-width: 100%;
        }
        .preview {
            width: 200px;
            height: 200px;
            overflow: hidden;
            border: 1px solid #ddd;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="crop-container">
        <h1>Upload & Crop Photo</h1>
        <input type="file" id="photoInput" accept="image/*">
        <div id="cropContainer">
            <img id="image" style="display: none;">
        </div>
        <button id="cropButton" style="display: none;">Crop</button>
        <div class="preview" id="preview"></div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.12/dist/cropper.min.js"></script>
    <script>
        let cropper;
        const photoInput = document.getElementById('photoInput');
        const image = document.getElementById('image');
        const cropButton = document.getElementById('cropButton');
        const preview = document.getElementById('preview');

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

            // Convert to Base64 or Blob for upload
            croppedCanvas.toBlob((blob) => {
                const formData = new FormData();
                formData.append('croppedImage', blob);

                // Upload to server
                fetch('/upload', {
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
