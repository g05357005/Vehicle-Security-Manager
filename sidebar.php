<!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Navigation</h3>
                </div>

                <ul class="list-unstyled components">
                    <p>Hello <?php echo ($_SESSION['name'] == '')?'User': $_SESSION['name'].'<span class="logout"><a href="./model/logout.php">Logout</a></span>';?></p>
                    <li class="active">
                        <a href="./index.php">QR Registration</a>
                    </li>
                    <li>
                        <a href="./model/reg_history.php">Registration History</a>
                    </li>
                    <li>
                        <a href="./model/scan_history.php">Security Scan History</a>
                    </li>
                </ul>
            </nav>