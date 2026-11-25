<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualización de Posts</title>
    <style>
        :root {
            --bg: #f2f5f8;
            --surface: #ffffff;
            --text: #1c2531;
            --muted: #5d6b7c;
            --line: #dde3ea;
            --accent: #0e6e6e;
            --accent-hover: #0a5656;
            --on-accent: #ffffff;

            --font-body: Georgia, "Iowan Old Style", "Palatino Linotype", serif;
            --font-ui: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --bg: #12171e;
                --surface: #1a212b;
                --text: #e6ebf1;
                --muted: #9aa7b7;
                --line: #2a3340;
                --accent: #4fc3c3;
                --accent-hover: #7bd8d8;
                --on-accent: #0c1a1a;
            }
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: var(--font-body);
            font-size: 1.125rem;
            line-height: 1.7;
        }

        .container {
            width: min(100% - 2rem, 42rem);
            margin-inline: auto;
            padding-block: 3rem 5rem;
        }

        /* Cabecera */
        .site-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 2.5rem;
            padding-bottom: 1.25rem;
            border-bottom: 1px solid var(--line);
        }

        .site-header h1 {
            margin: 0;
            font-family: var(--font-ui);
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.01em;
        }

        /* Botones y enlaces de acción */
        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            border: 1px solid var(--accent);
            border-radius: 6px;
            font-family: var(--font-ui);
            font-size: 0.9rem;
            font-weight: 600;
            line-height: 1.2;
            text-decoration: none;
            color: var(--accent);
            background: transparent;
            transition: background-color 0.15s, color 0.15s;
        }

        button.btn {
            cursor: pointer;
        }

        .btn:hover {
            background: var(--accent);
            color: var(--on-accent);
        }

        .btn-primary {
            background: var(--accent);
            color: var(--on-accent);
        }

        .btn-primary:hover {
            background: var(--accent-hover);
            border-color: var(--accent-hover);
        }

        a:focus-visible,
        .btn:focus-visible {
            outline: 3px solid var(--accent);
            outline-offset: 3px;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 1.5rem;
            font-family: var(--font-ui);
            font-size: 0.9rem;
            color: var(--muted);
            text-decoration: none;
        }

        .back-link:hover {
            color: var(--accent);
        }

        /* Posts (listado) */
        .post {
            padding: 1.75rem 1.75rem 1.5rem;
            margin-bottom: 1.5rem;
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 10px;
        }

        .post-title {
            margin: 0 0 0.75rem;
            font-size: 1.75rem;
            line-height: 1.25;
            letter-spacing: -0.01em;
        }

        .post-body {
            margin: 0 0 1.25rem;
            color: var(--text);
        }

        .post-actions {
            padding-top: 1rem;
            border-top: 1px solid var(--line);
        }

        .post-actions .btn {
            padding: 0.35rem 0.8rem;
            font-size: 0.85rem;
        }

        /* Post individual */
        .post-full {
            padding: 2rem;
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 10px;
        }

        .post-full .post-title {
            font-size: 2.25rem;
            margin-bottom: 1.5rem;
        }

        /* Estado vacío */
        .empty {
            padding: 2.5rem 1.5rem;
            text-align: center;
            color: var(--muted);
            font-family: var(--font-ui);
            border: 1px dashed var(--line);
            border-radius: 10px;
        }

        /* Formularios */
        .form-container {
            padding: 2rem;
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 10px;
        }

        .form-container h2 {
            margin: 0 0 1.5rem;
            font-size: 1.75rem;
            line-height: 1.25;
            letter-spacing: -0.01em;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.4rem;
            font-family: var(--font-ui);
            font-size: 0.9rem;
            font-weight: 600;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.65rem 0.8rem;
            font-family: var(--font-body);
            font-size: 1rem;
            line-height: 1.5;
            color: var(--text);
            background: var(--bg);
            border: 1px solid var(--line);
            border-radius: 6px;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .form-group textarea {
            min-height: 10rem;
            resize: vertical;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--accent) 25%, transparent);
        }

        .form-actions {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            margin-top: 1.5rem;
        }

        /* Mensajes */
        .alert {
            margin: 0 0 1.25rem;
            padding: 0.75rem 1rem;
            font-family: var(--font-ui);
            font-size: 0.95rem;
            line-height: 1.5;
            border-radius: 6px;
            border: 1px solid transparent;
        }

        .alert-error {
            color: #9b1c1c;
            background: #fdecec;
            border-color: #f5c2c2;
        }

        @media (prefers-color-scheme: dark) {
            .alert-error {
                color: #ffb4b4;
                background: #2d1a1a;
                border-color: #5a2a2a;
            }
        }

        @media (max-width: 480px) {
            body {
                font-size: 1.05rem;
            }

            .container {
                padding-block: 2rem 3rem;
            }

            .post,
            .post-full,
            .form-container {
                padding: 1.25rem;
            }

            .post-title {
                font-size: 1.45rem;
            }

            .post-full .post-title {
                font-size: 1.75rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <a class="back-link" href="<?= BASE_URL ?>/">&larr; Volver a los posts</a>

        <main>
            <div class="form-container">
                <h2>Actualizar post</h2>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input type="text" id="titulo" name="titulo" required>
                    </div>
                    <div class="form-group">
                        <label for="cuerpo">Cuerpo</label>
                        <textarea id="cuerpo" name="cuerpo" required></textarea>
                    </div>
                    <div class="form-actions">
                        <button class="btn btn-primary" type="submit" name="btnGuarda" value="ok">Guardar</button>
                        <a class="btn" href="<?= BASE_URL ?>/">Cancelar</a>
                    </div>
                </form>
            </div>
        </main>

    </div>
</body>

</html>