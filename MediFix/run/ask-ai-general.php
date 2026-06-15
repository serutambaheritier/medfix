<?php
session_start();
if (!isset($_SESSION['hbUser_Doctor'])) {
    echo "<script>window.location='index?please_login=true';</script>";
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MediFix AI Assistant</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="../assets/css/premium-theme.css" />
    <style>
        #aiResponse {
            padding: 1.5rem;
            border-radius: 10px;
            border: 1px solid #e0e0e0;
            background-color: #fcfcfc;
            margin-top: 1.5rem;
            min-height: 200px;
            font-size: 1.1rem;
            line-height: 1.6;
        }
        .chat-input {
            border-radius: 20px;
            padding: 15px 25px;
            border: 2px solid #5d87ff;
            font-size: 1.1rem;
        }
        .send-btn {
            border-radius: 50% !important;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
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
                <?php include('doctor-menu.php'); ?>
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
                <div class="card bg-light-primary shadow-none position-relative overflow-hidden mb-4">
                    <div class="card-body px-4 py-3">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h4 class="fw-semibold mb-8">AI Assistant</h4>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item" aria-current="page">Get instant help for medical equipment issues</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="col-3">
                                <div class="text-center mb-n5">
                                    <img src="../assets/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Ask a Question</h5>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="text" id="userInput" class="form-control chat-input" placeholder="Type your equipment issue here (e.g., Anesthesia machine making noise)...">
                                <button class="btn btn-primary send-btn" type="button" id="sendBtn">
                                    <i class="ti ti-send fs-6"></i>
                                </button>
                            </div>
                        </div>

                        <div id="aiResponse" style="display:none;">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary-subtle p-2 rounded-circle text-primary me-3">
                                    <i class="ti ti-robot fs-6"></i>
                                </div>
                                <h6 class="fw-semibold mb-0">MediFix AI Suggestions</h6>
                            </div>
                            <div id="aiContent"></div>
                        </div>

                        <div id="loading" style="display:none;" class="text-center p-5">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2">Analyzing and generating suggestions...</p>
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
        const userInput = document.getElementById('userInput');
        const sendBtn = document.getElementById('sendBtn');
        const aiResponse = document.getElementById('aiResponse');
        const aiContent = document.getElementById('aiContent');
        const loading = document.getElementById('loading');

        async function getAIResponse() {
            const query = userInput.value.trim();
            if (!query) return;

            aiResponse.style.display = 'none';
            loading.style.display = 'block';
            userInput.disabled = true;
            sendBtn.disabled = true;

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
                                content: `You are a helpful technical assistant for hospital equipment. If the request is not related to medical equipments, AI should respond advising to rephrase the question focusing on equipment. Provide the response in the following format:
                                <b><u>Potential Cause</u></b><br> [Cause description]<br><br>
                                <b><u>Proposed Solution</u></b><br> [Solution description]<br>
                                Use HTML formatting (bold, underline, line breaks, or lists if needed). Keep your tone professional and detailed. `
                            },
                            {
                                role: 'user',
                                content: query
                            }
                        ]
                    })
                });

                const data = await response.json();
                const reply = data.choices?.[0]?.message?.content?.trim() || '[No AI response available]';
                
                aiContent.innerHTML = `<p>${reply
                    .replace(/\*\*(.*?)\*\*/g, '<b>$1</b>')
                    .replace(/\n/g, '<br>')}</p>`;
                
                loading.style.display = 'none';
                aiResponse.style.display = 'block';
            } catch (error) {
                aiContent.innerHTML = `<p style="color:red;">[Error fetching AI response]</p>`;
                loading.style.display = 'none';
                aiResponse.style.display = 'block';
                console.error('AI fetch error:', error);
            } finally {
                userInput.disabled = false;
                sendBtn.disabled = false;
            }
        }

        sendBtn.addEventListener('click', getAIResponse);
        userInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') getAIResponse();
        });
    </script>

    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
<script src="../assets/js/theme-toggle.js"></script>
</body>

</html>
