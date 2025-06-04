<?php
session_start();
require_once 'database/db_connect.php';

// Check if user is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Include the dashboard header
include 'includes/header-dashboard.php';
?>

<div class="admin-dashboard">
    <div class="sidebar">
        <div class="navigation">
            <div class="menu-principal">MENU PRINCIPAL</div>
            <nav class="admin-nav">
                <ul>
                    <li class="nav-item active">
                        <img class="icon" src="images/icons/dashboard.svg" alt="Dashboard" />
                        <span>Tableau de bord</span>
                    </li>
                    <li class="nav-item">
                        <img class="icon" src="images/icons/agents.svg" alt="Agents" />
                        <span>Comptes Agents</span>
                    </li>
                    <li class="nav-item">
                        <img class="icon" src="images/icons/users.svg" alt="Users" />
                        <span>Comptes Voyageurs</span>
                    </li>
                    <li class="nav-item">
                        <img class="icon" src="images/icons/stats.svg" alt="Statistics" />
                        <span>Statistiques</span>
                    </li>
                    <li class="nav-item">
                        <img class="icon" src="images/icons/complaints.svg" alt="Complaints" />
                        <span>Réclamations</span>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <h1 class="dashboard-title">Tableau de bord</h1>
            <div class="search-bar">
                <img class="search-icon" src="images/icons/search.svg" alt="Search" />
                <input type="text" placeholder="Rechercher..." />
            </div>
        </div>

        <div class="stats-cards">
            <div class="stat-card complaints">
                <div class="stat-info">
                    <h3>Total Réclamations</h3>
                    <div class="stat-number">1,248</div>
                    <div class="stat-change positive">
                        <img src="images/icons/trend-up.svg" alt="Trend" />
                        <span>+12.5%</span>
                    </div>
                </div>
                <div class="stat-icon">
                    <img src="images/icons/complaints-large.svg" alt="Complaints" />
                </div>
            </div>

            <div class="stat-card agents">
                <div class="stat-info">
                    <h3>Comptes Agents</h3>
                    <div class="stat-number">84</div>
                    <div class="stat-change positive">
                        <img src="images/icons/trend-up.svg" alt="Trend" />
                        <span>+4.2%</span>
                    </div>
                </div>
                <div class="stat-icon">
                    <img src="images/icons/agents-large.svg" alt="Agents" />
                </div>
            </div>

            <div class="stat-card travelers">
                <div class="stat-info">
                    <h3>Comptes Voyageurs</h3>
                    <div class="stat-number">3,642</div>
                    <div class="stat-change positive">
                        <img src="images/icons/trend-up.svg" alt="Trend" />
                        <span>+18.7%</span>
                    </div>
                </div>
                <div class="stat-icon">
                    <img src="images/icons/users-large.svg" alt="Voyageurs" />
                </div>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="recent-complaints">
                <div class="section-header">
                    <h2>Réclamations récentes</h2>
                    <button class="view-all">Voir tout</button>
                </div>
                <div class="complaints-table">
                    <div class="table-header">
                        <div class="id">ID</div>
                        <div class="voyageur">Voyageur</div>
                        <div class="date">Date</div>
                        <div class="statut">Statut</div>
                        <div class="type">Type</div>
                    </div>
                    <div class="table-row-1">
                        <div class="_421">#421</div>
                        <div class="frame17">
                            <div class="frame18">
                                <div class="km">KM</div>
                            </div>
                            <div class="karim-meziane">Karim Meziane</div>
                        </div>
                        <div class="_12-05-2023">12/05/2023</div>
                        <div class="frame19">
                            <div class="en-cours">En cours</div>
                        </div>
                        <div class="retard-train">Retard train</div>
                    </div>
                    <div class="table-row-2">
                        <div class="_420">#420</div>
                        <div class="frame17">
                            <div class="frame18">
                                <div class="sb">SB</div>
                            </div>
                            <div class="sarah-benali">Sarah Benali</div>
                        </div>
                        <div class="_11-05-2023">11/05/2023</div>
                        <div class="frame20">
                            <div class="r-solu">Résolu</div>
                        </div>
                        <div class="remboursement">Remboursement</div>
                    </div>
                    <div class="table-row-3">
                        <div class="_419">#419</div>
                        <div class="frame17">
                            <div class="frame18">
                                <div class="ha">HA</div>
                            </div>
                            <div class="hamid-amrani">Hamid Amrani</div>
                        </div>
                        <div class="_10-05-2023">10/05/2023</div>
                        <div class="frame21">
                            <div class="rejet">Rejeté</div>
                        </div>
                        <div class="confort">Confort</div>
                    </div>
                    <div class="table-row-4">
                        <div class="_418">#418</div>
                        <div class="frame17">
                            <div class="frame18">
                                <div class="lk">LK</div>
                            </div>
                            <div class="leila-kadi">Leila Kadi</div>
                        </div>
                        <div class="_09-05-2023">09/05/2023</div>
                        <div class="frame20">
                            <div class="r-solu">Résolu</div>
                        </div>
                        <div class="bagage-perdu">Bagage perdu</div>
                    </div>
                </div>
            </div>

            <div class="dashboard-sidebar">
                <div class="stats-widget">
                    <h2>Statistiques</h2>
                    <div class="stats-chart">
                        <img class="frame22" src="frame34.svg" />
                    </div>
                    <div class="stats-summary">
                        <div class="stat-item">
                            <div class="frame7">
                                <div class="r-clamations-ce-mois">Réclamations ce mois</div>
                                <div class="_248">248</div>
                            </div>
                            <div class="frame8">
                                <img class="frame23" src="frame37.svg" />
                                <div class="_12-5">+12.5%</div>
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="frame7">
                                <div class="taux-de-r-solution">Taux de résolution</div>
                                <div class="_78">78%</div>
                            </div>
                            <div class="frame8">
                                <img class="frame24" src="frame40.svg" />
                                <div class="_4-2">+4.2%</div>
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="frame7">
                                <div class="temps-moyen-de-r-solution">
                                    Temps moyen de résolution
                                </div>
                                <div class="_3-2-jours">3.2 jours</div>
                            </div>
                            <div class="frame8">
                                <img class="frame25" src="frame43.svg" />
                                <div class="_0-5-jour">+0.5 jour</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="recent-activity">
                    <h2>Activité récente</h2>
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="frame26">
                                <img class="frame27" src="frame45.svg" />
                            </div>
                            <div class="frame28">
                                <div class="nouvelle-r-clamation-cr-e">
                                    Nouvelle réclamation créée
                                </div>
                                <div class="il-y-a-10-minutes">Il y a 10 minutes</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="frame29">
                                <img class="frame30" src="frame48.svg" />
                            </div>
                            <div class="frame28">
                                <div class="r-clamation-415-r-solue">
                                    Réclamation #415 résolue
                                </div>
                                <div class="il-y-a-45-minutes">Il y a 45 minutes</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="frame31">
                                <img class="frame32" src="frame51.svg" />
                            </div>
                            <div class="frame28">
                                <div class="nouvel-agent-ajout">Nouvel agent ajouté</div>
                                <div class="il-y-a-2-heures">Il y a 2 heures</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>