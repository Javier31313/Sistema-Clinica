<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | MVC</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>

    <!-- Figuras decorativas, mismas del login -->
    <div class="shape shape-blue"></div>
    <div class="shape shape-orange"></div>

    <div class="layout">

        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-logo">
                <span class="logo-text">&lt;/&gt; MVC</span>
            </div>

            <nav class="sidebar-nav">
                <a href="#" class="nav-item active">
                    <i class="fa-solid fa-gauge"></i>
                    <span>Resumen</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-users"></i>
                    <span>Usuarios</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-box"></i>
                    <span>Productos</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <span>Ventas</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Reportes</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-gear"></i>
                    <span>Configuración</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <a href="/logout" class="nav-item">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Cerrar sesión</span>
                </a>
            </div>
        </aside>

        <!-- CONTENIDO -->
        <div class="main">

            <!-- TOPBAR -->
            <header class="topbar">
                <div class="topbar-title">
                    <h1>Hola, Alejandro 👋</h1>
                    <p>Esto es lo que pasa en tu negocio hoy</p>
                </div>

                <div class="topbar-actions">
                    <div class="input-box search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Buscar...">
                    </div>

                    <button class="icon-btn">
                        <i class="fa-regular fa-bell"></i>
                        <span class="badge">3</span>
                    </button>

                    <div class="user-chip">
                        <div class="avatar">A</div>
                        <div class="user-info">
                            <strong>Alejandro Pérez</strong>
                            <small>Administrador</small>
                        </div>
                    </div>
                </div>
            </header>

            <!-- STAT CARDS -->
            <section class="stats-grid">
                <div class="glass-card stat-card">
                    <div class="stat-icon icon-blue"><i class="fa-solid fa-sack-dollar"></i></div>
                    <div class="stat-body">
                        <p>Ingresos totales</p>
                        <h3>$48,320</h3>
                        <span class="trend up"><i class="fa-solid fa-arrow-trend-up"></i> 12.4%</span>
                    </div>
                </div>

                <div class="glass-card stat-card">
                    <div class="stat-icon icon-orange"><i class="fa-solid fa-cart-shopping"></i></div>
                    <div class="stat-body">
                        <p>Pedidos nuevos</p>
                        <h3>1,204</h3>
                        <span class="trend up"><i class="fa-solid fa-arrow-trend-up"></i> 8.1%</span>
                    </div>
                </div>

                <div class="glass-card stat-card">
                    <div class="stat-icon icon-blue"><i class="fa-solid fa-users"></i></div>
                    <div class="stat-body">
                        <p>Usuarios activos</p>
                        <h3>3,872</h3>
                        <span class="trend down"><i class="fa-solid fa-arrow-trend-down"></i> 2.3%</span>
                    </div>
                </div>

                <div class="glass-card stat-card">
                    <div class="stat-icon icon-orange"><i class="fa-solid fa-rotate"></i></div>
                    <div class="stat-body">
                        <p>Tasa de retorno</p>
                        <h3>4.6%</h3>
                        <span class="trend up"><i class="fa-solid fa-arrow-trend-up"></i> 0.8%</span>
                    </div>
                </div>
            </section>

            <!-- CHART + ACTIVITY -->
            <section class="content-grid">

                <div class="glass-card chart-card">
                    <div class="card-header">
                        <h3>Ventas de la semana</h3>
                        <div class="legend">
                            <span><i class="dot dot-blue"></i> Este año</span>
                            <span><i class="dot dot-orange"></i> Año anterior</span>
                        </div>
                    </div>

                    <div class="bar-chart">
                        <div class="bar-group">
                            <div class="bar bar-blue" style="height: 55%;"></div>
                            <div class="bar bar-orange" style="height: 40%;"></div>
                            <span>Lun</span>
                        </div>
                        <div class="bar-group">
                            <div class="bar bar-blue" style="height: 70%;"></div>
                            <div class="bar bar-orange" style="height: 50%;"></div>
                            <span>Mar</span>
                        </div>
                        <div class="bar-group">
                            <div class="bar bar-blue" style="height: 45%;"></div>
                            <div class="bar bar-orange" style="height: 60%;"></div>
                            <span>Mié</span>
                        </div>
                        <div class="bar-group">
                            <div class="bar bar-blue" style="height: 90%;"></div>
                            <div class="bar bar-orange" style="height: 65%;"></div>
                            <span>Jue</span>
                        </div>
                        <div class="bar-group">
                            <div class="bar bar-blue" style="height: 65%;"></div>
                            <div class="bar bar-orange" style="height: 35%;"></div>
                            <span>Vie</span>
                        </div>
                        <div class="bar-group">
                            <div class="bar bar-blue" style="height: 80%;"></div>
                            <div class="bar bar-orange" style="height: 55%;"></div>
                            <span>Sáb</span>
                        </div>
                        <div class="bar-group">
                            <div class="bar bar-blue" style="height: 30%;"></div>
                            <div class="bar bar-orange" style="height: 20%;"></div>
                            <span>Dom</span>
                        </div>
                    </div>
                </div>

                <div class="glass-card activity-card">
                    <div class="card-header">
                        <h3>Actividad reciente</h3>
                    </div>

                    <ul class="activity-list">
                        <li>
                            <div class="activity-icon icon-blue"><i class="fa-solid fa-user-plus"></i></div>
                            <div class="activity-text">
                                <p><strong>Nuevo usuario</strong> registrado</p>
                                <small>Hace 5 minutos</small>
                            </div>
                        </li>
                        <li>
                            <div class="activity-icon icon-orange"><i class="fa-solid fa-box"></i></div>
                            <div class="activity-text">
                                <p><strong>Pedido #4521</strong> despachado</p>
                                <small>Hace 32 minutos</small>
                            </div>
                        </li>
                        <li>
                            <div class="activity-icon icon-blue"><i class="fa-solid fa-file-invoice"></i></div>
                            <div class="activity-text">
                                <p><strong>Factura</strong> generada</p>
                                <small>Hace 1 hora</small>
                            </div>
                        </li>
                        <li>
                            <div class="activity-icon icon-orange"><i class="fa-solid fa-triangle-exclamation"></i></div>
                            <div class="activity-text">
                                <p><strong>Stock bajo</strong> en producto X</p>
                                <small>Hace 3 horas</small>
                            </div>
                        </li>
                    </ul>
                </div>

            </section>

            <!-- TABLA -->
            <section class="glass-card table-card">
                <div class="card-header">
                    <h3>Pedidos recientes</h3>
                    <a href="#" class="forgot-link">Ver todos</a>
                </div>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Producto</th>
                                <th>Monto</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#4521</td>
                                <td>Carla Gómez</td>
                                <td>Laptop Pro 14"</td>
                                <td>$1,299</td>
                                <td><span class="status status-success">Completado</span></td>
                            </tr>
                            <tr>
                                <td>#4520</td>
                                <td>Marco Díaz</td>
                                <td>Auriculares X2</td>
                                <td>$89</td>
                                <td><span class="status status-pending">Pendiente</span></td>
                            </tr>
                            <tr>
                                <td>#4519</td>
                                <td>Laura Núñez</td>
                                <td>Monitor 27"</td>
                                <td>$349</td>
                                <td><span class="status status-success">Completado</span></td>
                            </tr>
                            <tr>
                                <td>#4518</td>
                                <td>José Ramírez</td>
                                <td>Teclado mecánico</td>
                                <td>$64</td>
                                <td><span class="status status-cancel">Cancelado</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

        </div>
    </div>

</body>
</html>