<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
            flex-wrap: wrap; /* Permite que baje de línea en pantallas muy pequeñas */
        }

        .site-header h1 {
            margin: 0;
            font-family: var(--font-ui);
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.01em;
        }

        /* Contenedor para agrupar los botones de la derecha */
        .header-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
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

        /* Posts */
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

        /* Estado vacío */
        .empty {
            padding: 2.5rem 1.5rem;
            text-align: center;
            color: var(--muted);
            font-family: var(--font-ui);
            border: 1px dashed var(--line);
            border-radius: 10px;
        }

        @media (max-width: 480px) {
            body {
                font-size: 1.05rem;
            }

            .container {
                padding-block: 2rem 3rem;
            }

            .post {
                padding: 1.25rem;
            }

            .post-title {
                font-size: 1.45rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <header class="site-header">
            <h1>Mi blog</h1>
            <div class="header-actions">
                <a class="btn" href="<?= BASE_URL ?>/crear">Nuevo post</a>
                <a class="btn" href="<?= BASE_URL ?>/loginUser">Iniciar sesión</a>
                <a class="btn btn-primary" href="<?= BASE_URL ?>/registerUsuario">Registrarse</a>
            </div>
        </header>

        <main>
            <?php if (empty($posts)) : ?>
                <p class="empty">No hay posts todavía. Crea el primero con el botón "Nuevo post".</p>
            <?php endif; ?>

            <?php foreach ($posts as $post) : ?>
                <article class="post">
                    <h2 class="post-title"><?= htmlspecialchars($post['title']) ?></h2>
                    <p class="post-body"><?= nl2br(htmlspecialchars($post['body'])) ?></p>
                    <div class="post-actions">
                        <a class="btn" href="<?= BASE_URL ?>/editar?id=<?= (int)$post['id'] ?>">Editar</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </main>

    </div>
</body>

</html>