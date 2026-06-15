<?php
session_start();
if (!isset($_SESSION['hbUser_Tech'])) {
    echo "<script>window.location='index?please_login=true';</script>";
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MediFix</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="../assets/css/premium-theme.css" />
    <style>
        #aiResponse {
            padding: 1rem;
            border: 1px solid #ccc;
            background-color: #f6f6f6;
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <aside class="left-sidebar">
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index" class="text-nowrap logo-img">
                        <img src="../assets/images/logos/dark-logo.svg" width="180" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <?php include('user-menu.php'); ?>
            </div>
        </aside>

        <div class="body-wrapper">
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item"><button class="theme-toggle-btn" title="Toggle Theme"><i class="ti ti-sun"></i></button></li>
              
              <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                      <div class="px-4 py-3 border-bottom mb-2">
                                        <h6 class="mb-0 fs-4 fw-semibold"><?php echo $_SESSION['hbUser_Name']; ?></h6>
                                        <span class="text-muted fs-3"><?php echo $_SESSION['hbUser_Type']; ?></span>
                                      </div>
                                        <a href="index" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <div class="container-fluid">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Ask Assistance for <?php echo $_GET['code']; ?></h5>

                            <?php
                            if (isset($_GET['new_record_added'])) {
                                echo "<div class='alert alert-success' role='alert'>A New Record Saved Successfully.</div>";
                            }

                            include('connector.php');
                            $query = mysqli_query($connect, "SELECT * FROM jobs WHERE code ='" . $_GET['code'] . "'");
                            $row = mysqli_fetch_array($query);
                            $airef = $row['info'];

                            $querydc = mysqli_query($connect, "SELECT * FROM dataset");
                            $dcCount = 0;
                            $newDataSet = [];
                            while ($rowdc = mysqli_fetch_array($querydc)) {
                                similar_text($airef, $rowdc['issue'], $percent);
                                $newDataSet[$dcCount]['percent'] = $percent;
                                $newDataSet[$dcCount]['issueid'] = $rowdc['id'];
                                $dcCount++;
                            }

                            rsort($newDataSet);

                            $queryd = mysqli_query($connect, "SELECT * FROM dataset WHERE id = '" . $newDataSet[0]['issueid'] . "' ");
                            $rowd = mysqli_fetch_array($queryd);

                            echo "<p><b>Equipment:</b> " . $row['equipment'] . "</p>";
                            echo "<p><b>More info:</b> " . $row['info'] . "</p>";

                            ?>

                            <!-- AI Response Section -->
                            <h5 class="card-title fw-semibold mt-5 mb-3">Additional Suggestions</h5>
                            <div id="aiResponse"><em>Loading AI suggestions...</em></div>

                            <br><br>
                            <a href='job-request-view-u-p?code=<?php echo $row['code']; ?>'>
                                <button type='button' class='btn btn-outline-primary'>Back</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-6 px-6 text-center">
                <p class="mb-0 fs-4">Designed and Developed by Jemima</p>
            </div>
        </div>
    </div>

    <script>
        const infoText = `<?php echo addslashes($airef); ?>`;

        async function getAIResponse() {
            try {
                const response = await fetch('ai-proxy.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        model: 'gpt-3.5-turbo',
                        messages: [{
                                role: 'system',
                                content: `You are a helpful technical assistant for hospital equipment if the request is not related to medical equipments, AI should respons advising to rephrase the question. Based on the user's issue description, provide the response in the following format:
                                <b><u>Potential Cause</u></b><br> [Cause description]<br><br>
                                <b><u>Proposed Solution</u></b><br> [Solution description]<br>
                                Use HTML formatting (bold, underline, line breaks, or lists if needed). Keep your tone professional and developed, like give more content. `

                            },
                            {
                                role: 'user',
                                content: infoText
                            }
                        ]
                    })
                });

                const data = await response.json();
                const reply = data.choices?.[0]?.message?.content?.trim() || '[No AI response available]';
                document.getElementById('aiResponse').innerHTML = `<p>${reply
  .replace(/\*\*(.*?)\*\*/g, '<b>$1</b>')  // Convert **bold** to <b>bold</b>
  .replace(/\n/g, '<br>')}</p>`;
            } catch (error) {
                document.getElementById('aiResponse').innerHTML = `<p style="color:red;">[Error fetching AI response]</p>`;
                console.error('AI fetch error:', error);
            }
        }

        window.addEventListener('DOMContentLoaded', getAIResponse);
    </script>

    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>
<script src="../assets/js/theme-toggle.js"></script>
</body>

</html>