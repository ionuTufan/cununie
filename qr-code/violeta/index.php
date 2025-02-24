<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Încărcați pozele și mesajele - Cununie Civilă</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sriracha&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Sriracha", serif;
        }
        body {
  font-family: "Sriracha", serif;
            background: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .container {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(5px);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            margin-bottom: 0;
        }
        h2 {
            color: #333;
            margin-bottom: 15px;
        }
        p {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
        }
        input[type="file"] {
            display: none;
        }
        .custom-file-upload {
            background: #1b9f1a;
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
            font-weight: 600;
            transition: 0.3s;
        }
        .custom-file-upload:hover {
            background: #09ff07;
        }
        #upload-btn {
            background: #1b9f1a;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            margin-top: 10px;
            transition: 0.3s;
            display: none;
        }
        #upload-btn:hover {
            background: #09ff07;
        }
        .preview-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 15px;
            overflow-y: auto;
            max-height: 300px;
        }
        .preview-container div {
            position: relative;
            width: 32%;
            margin-bottom: 15px;
        }
        .preview-container img, .preview-container video {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .delete-btn {
            position: absolute;
            top: 0;
            right: 0;
            background: red;
            color: white;
            font-weight: bold;
            border: none;
            padding: 5px;
            cursor: pointer;
        }
        .delete-btn:hover {
            background: #09ff07;
        }
        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 80px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            display: none;
            width: 400px;
        }
        .popup i {
            font-size: 50px;
            color: #1b9f1a;
        }
        .popup p {
            margin-top: 10px;
            font-size: 18px;
            color: #333;
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            font-weight: bold;
            color: #777;
            cursor: pointer;
        }
        .close-btn:hover {
            color: #333;
        }
        body {
            background-image: url('https://i.imgur.com/Lq8mgHu_d.webp?maxwidth=760&fidelity=grand');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            color: white;
            text-align: center;
        }
        .upload-container {
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            margin: auto;
            margin-top: 50px;
        }
        button {
            background-color: #1b9f1a;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: 0.3s;
        }
        button:hover {
            background-color: #09ff07;
        }
        #send-message-btn {
        transition: background-color 0.3s ease; /* Adăugăm o tranziție pentru o schimbare mai lină a culorii */
    }

    #send-message-btn:hover {
        background-color: #09ff07; /* Culoarea albastră dorită la hover */
    }





/* 🔄 Loader full-screen */
#loading-spinner {
    display: none; /* Inițial este ascuns */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7); /* Fundal mai întunecat */
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999; /* Peste orice alt element */
}

#loading-spinner p {
    color: white;
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 15px;
}

/* 🌀 Loader animat */
#loading-spinner .spinner {
    width: 50px;
    height: 50px;
    border: 5px solid rgba(255, 255, 255, 0.3);
    border-top: 5px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}


    </style>
</head>
<body>
<div id="loading-spinner">
    <div>
        <p>Se procesează...</p>
        <div class="spinner"></div>
    </div>
</div>


    <div class="container">
        <h2>Încărcați pozele și videoclipurile 📸🎥</h2>
        <p>Ajutați-ne să păstrăm amintirile frumoase! <br>Selectați pozele sau videoclipurile făcute în timpul evenimentului, verificați-le și încărcați-le.</p>
        <form id="upload-form">
            <label for="file" class="custom-file-upload">📂 Alege fișiere</label>
            <input type="file" name="files[]" id="file" accept="image/*,video/*" multiple required>
            <div class="preview-container" id="preview"></div>
            <button type="submit" id="upload-btn">📤 Încărcați fișierele</button>
            <!-- Buton Înapoi pentru încărcare fișiere (initial ascuns) -->
            <button type="button" id="back-to-main-btn" style="background-color: rgb(255 0 0); color: #ffffff; margin-top: 10px; border: none; padding: 10px 20px; font-size: 16px; cursor: pointer; border-radius: 5px; display: none;">Înapoi</button>
        </form>
        
        <!-- Buton și formular pentru mesaj -->
        <button id="message-btn">💬 Lasă un mesaj despre eveniment</button>
        <div id="message-form-container" style="display: none; margin-top: 20px;">
            <input type="text" id="user-name" placeholder="Numele tău (opțional)" style="width: 100%; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
            <textarea id="message-text" placeholder="Scrie mesajul tău aici..." rows="5" style="width: 100%; padding: 10px; border-radius: 5px;"></textarea>
        <button id="send-message-btn" style="margin-top: 10px;  color: #ffffff; border: none; padding: 10px 20px; font-size: 16px; cursor: pointer; border-radius: 5px;">Trimite mesajul</button>
            <!-- Buton Înapoi pentru mesaj (initial ascuns) -->
            <button type="button" id="back-to-main-btn-message" style="background-color: rgb(255 0 0); color: black; margin-top: 10px; border: none; padding: 10px 20px; font-size: 16px; cursor: pointer; border-radius: 5px; display: none;">Înapoi</button>
        </div>
    </div>
    
    <!-- Pop-up de succes -->
    <div class="popup" id="success-popup">
        <span class="close-btn" onclick="resetPage()">×</span>
        <img src="https://media2.giphy.com/media/v1.Y2lkPTc5MGI3NjExbWx3NGJpeWZyNzZ4Y2RveTVweWc0YzdkdHU5cHczMGFjMzAzem9nZSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/tf9jjMcO77YzV4YPwE/giphy.gif" alt="Succes" style="width: 80px;">
        <p>Succes! Fișierele sau mesajul au fost trimise.</p>
    </div>

<script>
    // Cod pentru încărcarea fișierelor
    document.getElementById('file').addEventListener('change', function(event) {
        let previewContainer = document.getElementById('preview');
        let uploadBtn = document.getElementById('upload-btn');
        let messageBtn = document.getElementById('message-btn');
        let backBtn = document.getElementById('back-to-main-btn');  // Butonul Înapoi

        previewContainer.innerHTML = '';

        if (this.files.length > 0) {
            uploadBtn.style.display = 'inline-block';
            messageBtn.style.display = 'none'; // Ascunde butonul pentru mesaj
            backBtn.style.display = 'inline-block'; // Afișează butonul Înapoi
            document.getElementById('message-form-container').style.display = 'none'; // Ascunde formularul de mesaje
        } else {
            uploadBtn.style.display = 'none';
            messageBtn.style.display = 'inline-block'; // Afișează butonul pentru mesaj
            backBtn.style.display = 'none'; // Ascunde butonul Înapoi
        }

        for (let i = 0; i < this.files.length; i++) {
            let file = this.files[i];
            let reader = new FileReader();

            reader.onload = function(e) {
                let fileContainer = document.createElement('div');
                let fileElement;

                if (file.type.startsWith('image/')) {
                    fileElement = document.createElement('img');
                    fileElement.src = e.target.result;
                } else if (file.type.startsWith('video/')) {
                    fileElement = document.createElement('video');
                    fileElement.src = e.target.result;
                    fileElement.controls = true;
                }

                let deleteBtn = document.createElement('button');
                deleteBtn.classList.add('delete-btn');
                deleteBtn.textContent = 'X';
                deleteBtn.onclick = function() {
                    fileContainer.remove();
                };

                fileContainer.appendChild(fileElement);
                fileContainer.appendChild(deleteBtn);
                previewContainer.appendChild(fileContainer);
            };

            reader.readAsDataURL(file);
        }
    });

    // Cod pentru mesaj
    document.getElementById('message-btn').addEventListener('click', function() {
        document.getElementById('message-form-container').style.display = 'block';
        this.style.display = 'none'; // Ascunde butonul de mesaj
        document.querySelector('.custom-file-upload').style.display = 'none'; // Ascunde butonul de încărcare fișiere
        document.getElementById('back-to-main-btn').style.display = 'none'; // Ascunde butonul Înapoi pentru încărcare fișiere
        document.getElementById('back-to-main-btn-message').style.display = 'inline-block'; // Afișează butonul Înapoi pentru mesaj
    });

    document.getElementById('send-message-btn').addEventListener('click', function() {
        let message = document.getElementById('message-text').value.trim();
        let name = document.getElementById('user-name').value.trim(); // Numele

        if (message) {
            let formData = new FormData();
            formData.append('message', message);
            formData.append('name', name); // Adaugă și numele

            fetch('save_message.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('message-form-container').style.display = 'none';
                    document.getElementById('message-btn').style.display = 'inline-block'; // Arată înapoi butonul
                    document.querySelector('.custom-file-upload').style.display = 'inline-block'; // Arată înapoi butonul de încărcare fișiere
                    showSuccessPopup("Mesaj trimis! Mulțumim pentru contribuție!");
                } else {
                    alert(data.message); // Afișează mesajul de eroare
                }
            })
            .catch(error => console.error('Eroare:', error));
        } else {
            alert("Te rugăm să scrii un mesaj.");
        }
    });

    // Funcție pentru a arăta popup-ul de succes
    function showSuccessPopup(message) {
        let popup = document.getElementById('success-popup');
        popup.style.display = 'block';
        popup.querySelector('p').textContent = message;
    }

    // Cod pentru formularul de încărcare fișiere
    document.getElementById('upload-form').addEventListener('submit', function(event) {
        event.preventDefault();
        let formData = new FormData(this);

        fetch('upload.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())  // schimbă aici pentru a obține textul complet
        .then(data => {
            console.log(data);  // Vezi ce trimite serverul
            try {
                const jsonData = JSON.parse(data);  // Parsează doar dacă este JSON valid
                if (jsonData.success) {
                    showSuccessPopup("Fișierele au fost încărcate!");
                } else {
                    alert(jsonData.message);
                }
            } catch (error) {
                console.error('Eroare la interpretarea JSON-ului:', error);
                alert("A apărut o problemă la server. Te rugăm să încerci din nou.");
            }
        })
        .catch(error => console.error('Eroare:', error));
    });

   // Resetare și închidere popup cu refresh la pagină
    function resetPage() {
        let popup = document.getElementById('success-popup');
        popup.style.display = 'none';

        document.getElementById('back-to-main-btn').style.display = 'none';
        document.getElementById('message-btn').style.display = 'inline-block';
        document.querySelector('.custom-file-upload').style.display = 'inline-block';
        document.getElementById('file').value = '';
        document.getElementById('preview').innerHTML = '';

        location.reload(); // Reîncarcă pagina după închiderea popup-ului
    }

    // Cod pentru butonul Înapoi (fișiere)
    document.getElementById('back-to-main-btn').addEventListener('click', function() {
        location.reload();  // Reîncarcă pagina
    });

    // Cod pentru butonul Înapoi (mesaj)
    document.getElementById('back-to-main-btn-message').addEventListener('click', function() {
        location.reload();  // Reîncarcă pagina
    });


























// 🌀 Funcție pentru a arăta loader-ul
function showLoader() {
    document.getElementById('loading-spinner').style.display = 'flex';
}

// ✅ Funcție pentru a ascunde loader-ul
function hideLoader() {
    document.getElementById('loading-spinner').style.display = 'none';
}

// 🖋️ Formular de mesaje
document.getElementById('send-message-btn').addEventListener('click', function() {
    let message = document.getElementById('message-text').value.trim();
    let name = document.getElementById('user-name').value.trim();

    if (!message) {
        alert("Te rugăm să scrii un mesaj.");
        return;
    }

    let formData = new FormData();
    formData.append('message', message);
    formData.append('name', name);

    showLoader(); // 🌀 Arată loader-ul înainte de trimiterea mesajului

    fetch('save_message.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        hideLoader(); // ✅ Ascunde loader-ul după finalizarea trimiterea mesajului

        if (data.success) {
            document.getElementById('message-form-container').style.display = 'none';
            document.getElementById('message-btn').style.display = 'inline-block';
            document.querySelector('.custom-file-upload').style.display = 'inline-block';
            showSuccessPopup("Mesaj trimis! Mulțumim pentru contribuție!");
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        hideLoader(); // ✅ Ascunde loader-ul în caz de eroare
        console.error('Eroare:', error);
    });
});

// 📤 Formular încărcare fișiere
document.getElementById('upload-form').addEventListener('submit', function(event) {
    event.preventDefault();
    let formData = new FormData(this);

    showLoader(); // 🌀 Arată loader-ul înainte de încărcare fișiere

    fetch('upload.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())  // Așteptăm răspunsul serverului (JSON)
    .then(data => {
        hideLoader(); // ✅ Ascunde loader-ul după încărcarea fișierelor

        if (data.success) {
            showSuccessPopup("Fișier încărcat cu succes!");
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        hideLoader(); // ✅ Ascunde loader-ul în caz de eroare
        console.error('Eroare:', error);
    });
});

// 🌀 Funcție pentru a ascunde loader-ul la încărcarea paginii
window.addEventListener('load', function() {
    hideLoader(); // Asigură-te că loader-ul este ascuns la încărcarea completă a paginii
});

</script>



</body>
</html>