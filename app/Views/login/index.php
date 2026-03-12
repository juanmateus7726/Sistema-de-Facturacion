<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Sistema de Facturación</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #edf2f7 0%, #e2e8f0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }
        
        /* Patrón de fondo sutil */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                linear-gradient(rgba(45, 55, 72, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(45, 55, 72, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: 0;
        }
        
        .login-container {
            width: 100%;
            max-width: 480px;
            position: relative;
            z-index: 1;
        }
        
        .login-card {
            background: white;
            border-radius: 24px;
            padding: 60px 50px;
            box-shadow: 
                0 10px 40px rgba(0, 0, 0, 0.08),
                0 2px 8px rgba(0, 0, 0, 0.04);
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            border: 1px solid rgba(226, 232, 240, 0.8);
            position: relative;
        }
        
        /* Efecto de brillo sutil en el card */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, 
                transparent, 
                rgba(74, 85, 104, 0.5), 
                transparent
            );
            border-radius: 24px 24px 0 0;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .login-logo {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .logo-icon-wrapper {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 
                0 8px 20px rgba(74, 85, 104, 0.2),
                0 2px 4px rgba(74, 85, 104, 0.1);
            position: relative;
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-8px);
            }
        }
        
        .logo-icon-wrapper::after {
            content: '';
            position: absolute;
            inset: -2px;
            background: linear-gradient(135deg, #4a5568, #2d3748);
            border-radius: 20px;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .login-card:hover .logo-icon-wrapper::after {
            opacity: 0.3;
        }
        
        .logo-icon-wrapper i {
            font-size: 42px;
            color: white;
        }
        
        .login-logo h2 {
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 8px;
            font-size: 26px;
            letter-spacing: -0.5px;
        }
        
        .login-logo p {
            color: #718096;
            font-size: 14px;
            font-weight: 500;
        }
        
        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 10px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .input-group {
            margin-bottom: 24px;
        }
        
        .input-wrapper {
            position: relative;
            display: flex;
            align-items: stretch;
            background: #f7fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        
        .input-wrapper:focus-within {
            background: white;
            border-color: #4a5568;
            box-shadow: 0 0 0 4px rgba(74, 85, 104, 0.1);
        }
        
        .input-icon {
            display: flex;
            align-items: center;
            padding: 0 16px;
            color: #718096;
            transition: color 0.3s;
        }
        
        .input-wrapper:focus-within .input-icon {
            color: #4a5568;
        }
        
        .form-control {
            flex: 1;
            border: none;
            background: transparent;
            padding: 14px 16px 14px 0;
            font-size: 15px;
            color: #2d3748;
            font-weight: 500;
        }
        
        .form-control:focus {
            outline: none;
            box-shadow: none;
        }
        
        .form-control::placeholder {
            color: #a0aec0;
            font-weight: 400;
        }
        
        .toggle-password {
            background: transparent;
            border: none;
            color: #718096;
            padding: 0 16px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .toggle-password:hover {
            color: #4a5568;
        }
        
        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%);
            border: none;
            border-radius: 12px;
            padding: 16px;
            font-size: 15px;
            font-weight: 700;
            color: white;
            margin-top: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(74, 85, 104, 0.3);
            letter-spacing: 0.5px;
            text-transform: uppercase;
            position: relative;
            overflow: hidden;
        }
        
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, 
                transparent, 
                rgba(255, 255, 255, 0.2), 
                transparent
            );
            transition: left 0.5s;
        }
        
        .btn-login:hover::before {
            left: 100%;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(74, 85, 104, 0.4);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .alert {
            border-radius: 12px;
            border: none;
            padding: 14px 18px;
            margin-bottom: 28px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .alert i {
            font-size: 18px;
        }
        
        .alert-danger {
            background: #fff5f5;
            color: #742a2a;
            border-left: 4px solid #f56565;
        }
        
        .alert-success {
            background: #f0fff4;
            color: #22543d;
            border-left: 4px solid #48bb78;
        }
        
        .footer-text {
            text-align: center;
            margin-top: 32px;
            color: #a0aec0;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .footer-text i {
            color: #48bb78;
            font-size: 16px;
        }
        
        /* Animación del spinner */
        .btn-login .spinner-border {
            width: 18px;
            height: 18px;
            border-width: 2px;
        }
        
        /* Responsive */
        @media (max-width: 576px) {
            .login-card {
                padding: 40px 30px;
            }
            
            .login-logo h2 {
                font-size: 22px;
            }
            
            .logo-icon-wrapper {
                width: 70px;
                height: 70px;
            }
            
            .logo-icon-wrapper i {
                font-size: 36px;
            }
        }
    </style>
</head>
<body>
    
    <div class="login-container">
        <div class="login-card">
            <!-- Logo y título -->
            <div class="login-logo">
                <div class="logo-icon-wrapper">
                    <i class="bi bi-shop-window"></i>
                </div>
                <h2>Sistema de Facturación</h2>
                <p>Ingrese sus credenciales para continuar</p>
            </div>
            
            <!-- Alertas -->
            <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span><?= session()->getFlashdata('error') ?></span>
            </div>
            <?php endif; ?>
            
            <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <i class="bi bi-check-circle-fill"></i>
                <span><?= session()->getFlashdata('success') ?></span>
            </div>
            <?php endif; ?>
            
            <!-- Formulario -->
            <form method="POST" action="<?= base_url('login/autenticar') ?>" id="loginForm">
                
                <div class="mb-3">
                    <label class="form-label">Usuario</label>
                    <div class="input-wrapper">
                        <div class="input-icon">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <input type="text" 
                               name="usuario" 
                               class="form-control" 
                               placeholder="Ingrese su usuario"
                               required
                               autofocus>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="form-label">Contraseña</label>
                    <div class="input-wrapper">
                        <div class="input-icon">
                            <i class="bi bi-lock-fill"></i>
                        </div>
                        <input type="password" 
                               name="password" 
                               id="password"
                               class="form-control" 
                               placeholder="Ingrese su contraseña"
                               required>
                        <button class="toggle-password" 
                                type="button" 
                                onclick="togglePassword()">
                            <i class="bi bi-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-login" id="btnLogin">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Iniciar Sesión
                </button>
                
            </form>
            
            <div class="footer-text">
                <i class="bi bi-shield-check"></i>
                <span>Sistema seguro y confiable</span>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle password visibility
        function togglePassword() {
            const password = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            
            if (password.type === 'password') {
                password.type = 'text';
                icon.className = 'bi bi-eye-slash';
            } else {
                password.type = 'password';
                icon.className = 'bi bi-eye';
            }
        }
        
        // Animación al enviar formulario
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('btnLogin');
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Iniciando sesión...';
            btn.disabled = true;
        });
    </script>
</body>
</html>