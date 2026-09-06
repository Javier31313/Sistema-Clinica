<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control Clínico</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css">
</head>
<body>

    <!-- Sidebar Bar -->
    <aside class="sidebar">
        <div class="brand">
            <i class="fa-solid fa-user-nurse"></i>
            <span>MediCare</span>
        </div>
        <ul class="nav-list">
            <li class="nav-item active"><a href="/dashboard"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
            <li class="nav-item"><a href="/pacientes"><i class="fa-solid fa-hospital-user"></i> Pacientes</a></li>
            <li class="nav-item"><a href="#"><i class="fa-solid fa-calendar-check"></i> Citas Médicas</a></li>
            <li class="nav-item"><a href="#"><i class="fa-solid fa-stethoscope"></i> Consultas</a></li>
            <li class="nav-item"><a href="/historial"><i class="fa-solid fa-file-medical"></i>Historial Clínico</a></li>
            <li class="nav-item"><a href="#"><i class="fa-solid fa-gear"></i> Configuración</a></li>
            <li class="nav-item"><a href="/logout" class="btn w-100 text-white" style="background-color: #94A9BE;"><span class="me-2">🚪</span>Cerrar Sesión</a></li>
        </ul>
    </aside>

    <div class="main-content">
        <header>
            <div class="search-bar">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Buscar paciente por DUI o nombre...">
            </div>
            <div class="user-profile">
                <div>
                    <strong style="display: block; font-size: 0.9rem;"><?= $_SESSION['user'] ?></strong>
                    <span style="font-size: 0.75rem; color: var(--text-muted);">Medicina General</span>
                </div>
                <div class="avatar"><img class="imagen-avatar" src="img/blue_users_customers_clients_people_12438.png" alt=""></div>

            </div>
        </header>

        <div class="dashboard-container">
            <div class="metrics-grid">
                <div class="card">
                    <div class="card-icon" style="background-color: #e0f2fe; color: var(--primary);">
                        <i class="fa-solid fa-hospital-user"></i>
                    </div>
                    <div class="card-info">
                        <h3>Pacientes Totales</h3>
                        <p>1,248</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-icon" style="background-color: #dcfce7; color: var(--accent-green);">
                        <i class="fa-solid fa-calendar-day"></i>
                    </div>
                    <div class="card-info">
                        <h3>Citas de Hoy</h3>
                        <p>18</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-icon" style="background-color: #fef3c7; color: var(--accent-amber);">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div class="card-info">
                        <h3>En Espera</h3>
                        <p>5</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-icon" style="background-color: #f3e8ff; color: var(--accent-purple);">
                        <i class="fa-solid fa-notes-medical"></i>
                    </div>
                    <div class="card-info">
                        <h3>Atendidos Hoy</h3>
                        <p>13</p>
                    </div>
                </div>
            </div>

            <div class="content-grid">
                <div class="panel">
                    <div class="panel-header">
                        <h2>Próximas Citas de Pacientes</h2>
                        <button class="btn-action">+ Nuevo Paciente</button>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Paciente</th>
                                <th>Hora</th>
                                <th>Doctor / Especialidad</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>María Hernández</strong></td>
                                <td>09:00 AM</td>
                                <td>Dr. Gómez (General)</td>
                                <td><span class="status-badge status-confirmed">Confirmada</span></td>
                            </tr>
                            <tr>
                                <td><strong>Carlos Ramos</strong></td>
                                <td>09:30 AM</td>
                                <td>Dra. Martínez (Pediatría)</td>
                                <td><span class="status-badge status-confirmed">Confirmada</span></td>
                            </tr>
                            <tr>
                                <td><strong>Ana Morales</strong></td>
                                <td>10:15 AM</td>
                                <td>Dr. Gómez (General)</td>
                                <td><span class="status-badge status-pending">En espera</span></td>
                            </tr>
                            <tr>
                                <td><strong>Luis Rodríguez</strong></td>
                                <td>11:00 AM</td>
                                <td>Dr. Pérez (Cardiología)</td>
                                <td><span class="status-badge status-pending">Pendiente</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="panel">
                    <div class="panel-header">
                        <h2>Actividad Reciente</h2>
                    </div>
                    <ul class="activity-list">
                        <li class="activity-item">
                            <div class="activity-dot"></div>
                            <div class="activity-details">
                                <p>Historia clínica actualizada para <strong>María Hernández</strong>.</p>
                                <span>Hace 10 min</span>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-dot" style="background-color: var(--accent-green);"></div>
                            <div class="activity-details">
                                <p>Nuevo paciente registrado: <strong>José Cañas</strong>.</p>
                                <span>Hace 35 min</span>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-dot" style="background-color: var(--accent-amber);"></div>
                            <div class="activity-details">
                                <p>Cita cancelada por <strong>Sofía Rivas</strong>.</p>
                                <span>Hace 1 hora</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</body>
</html>