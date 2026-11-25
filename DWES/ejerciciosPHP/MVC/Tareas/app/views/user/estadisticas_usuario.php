<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Tareas</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>📋 Estadísticas del usuario</h1>
            <nav>
                <a href="index.php?action=home">Inicio</a>
                <a href="index.php?action=misTareas">Mis Tareas</a>
                <a href="index.php?action=misEstadisticas">Estadísticas</a>
                <span>Hola, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></span>
                <a href="index.php?action=logout">Cerrar Sesión</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <div class="header-seccion">
            <h2>Mis estadísticas</h2>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?php 
                echo htmlspecialchars($_SESSION['error']); 
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-success">
                <?php 
                echo htmlspecialchars($_SESSION['mensaje']); 
                unset($_SESSION['mensaje']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($totalTareas) && $totalTareas > 0): ?>
            <div class="dashboard-grid">
                <!-- Recuadro 1: Total de Tareas -->
                <div class="card-stat">
                    <h3>Total de tareas</h3>
                    <div class="stat-number">
                        <?php echo htmlspecialchars($totalTareas); ?>
                    </div>
                </div>

                <!-- Recuadro 2: Por Estado -->
                <div class="card-stat">
                    <h3>Estado</h3>
                    <ul class="stat-list">
                        <li><span>Pendiente:</span> <strong><?php echo $statsEstado['pendiente'] ?? 0; ?></strong></li>
                        <li><span>En Progreso:</span> <strong><?php echo $statsEstado['en_progreso'] ?? 0; ?></strong></li>
                        <li><span>Completado:</span> <strong><?php echo $statsEstado['completado'] ?? 0; ?></strong></li>
                    </ul>
                </div>

                <!-- Recuadro 3: Por Fase -->
                <div class="card-stat">
                    <h3>Fase</h3>
                    <ul class="stat-list">
                        <li><span>Análisis:</span> <strong><?php echo $statsFase['analisis'] ?? 0; ?></strong></li>
                        <li><span>Diseño:</span> <strong><?php echo $statsFase['diseno'] ?? 0; ?></strong></li>
                        <li><span>Codificación:</span> <strong><?php echo $statsFase['codificacion'] ?? 0; ?></strong></li>
                        <li><span>Pruebas:</span> <strong><?php echo $statsFase['pruebas'] ?? 0; ?></strong></li>
                        <li><span>Despliegue:</span> <strong><?php echo $statsFase['despliegue'] ?? 0; ?></strong></li>
                    </ul>
                </div>
            </div>
        <?php else: ?>
            <div class="mensaje-info">
                <p>No tienes tareas creadas todavía.</p>
                <a href="index.php?action=crearTarea" class="btn">Crear mi primera tarea</a>
            </div>
        <?php endif; ?>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Sistema de Gestión de Tareas - Ejemplo Didáctico MVC</p>
        </div>
    </footer>
</body>
</html>