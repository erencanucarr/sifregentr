<?php
require_once __DIR__ . '/src/PasswordGenerator.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Password Generator - Create Strong Passwords</title>
    <meta name="description" content="Generate strong, secure passwords with our advanced password generator. Create unique passwords that protect your online accounts.">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div id="particles-js" style="position:fixed; width:100vw; height:100vh; z-index:-1; top:0; left:0;"></div>
    <header>
        <nav>
            <div class="logo">Sifre.gen.tr</div>
            <ul>
                <li><a href="#generator">Şifre Üretici</a></li>
                <li><a href="#features">Özellikler</a></li>
                <li><a href="https://eren.gg" target="_blank" rel="noopener noreferrer">Developer</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="generator" class="generator-section">
            <h1 class="section-title">Şifre Üretici</h1>
            <p class="section-description">Hesaplarınızı güvende tutmak için güçlü, benzersiz parolalar oluşturun.</p>
            
            <div class="password-display">
                <input type="text" id="passwordOutput" class="password-input" readonly>
                <button class="copy-btn" id="copyBtn" title="Copy to clipboard">
                    <i class="fas fa-copy"></i>
                </button>
            </div>
            
            <div class="options-grid">
                <div class="option-group">
                    <h3 class="option-title">Şifre Uzunluğu</h3>
                    <div class="slider-container">
                        <div class="slider-header">
                            <span>Length:</span>
                            <span id="lengthValue">16</span>
                        </div>
                        <input type="range" min="8" max="64" value="16" id="lengthSlider">
                    </div>
                </div>
                
                <div class="option-group">
                    <h3 class="option-title">Karakter Tipleri</h3>
                    <div class="checkbox-group">
                        <label class="custom-checkbox">
                            <input type="checkbox" checked id="lowercase">
                            <span>Küçük Harf (a-z)</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" checked id="uppercase">
                            <span>Büyük Harf (A-Z)</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" checked id="numbers">
                            <span>Rakam (0-9)</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" checked id="symbols">
                            <span>Özel KArakter (!@#$%^&*)</span>
                        </label>
                    </div>
                </div>
            </div>
            
            <button id="generateBtn" class="generate-btn">
                Şifre Oluştur
            </button>
        </section>

        <section id="features" class="features-section container">
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-shield-alt"></i>
                    <h3>Güçlü & Güvenli</h3>
                    <p>Güvenli ve güçlü parolalar ile hesaplarınızı güvene alın.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-sliders-h"></i>
                    <h3>Özelleştirilebilir</h3>
                    <p>Dilediğiniz şekilde parolalar oluşturun.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-check-circle"></i>
                    <h3>Basit Kullanım</h3>
                    <p>Tek tıklamayla panoya kopyalama işlevine sahip basit arayüz.</p>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>
