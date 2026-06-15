<?php session_start();
if (!isset($_SESSION['hbUser_Doctor'])) {
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
    .ai-chat-container {
      display: flex;
      flex-direction: column;
      height: 600px;
      background: rgba(26, 26, 46, 0.6);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 16px;
      overflow: hidden;
    }
    .ai-chat-header {
      background: rgba(59, 130, 246, 0.15);
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      padding: 16px 24px;
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .ai-chat-header .ai-avatar {
      width: 42px;
      height: 42px;
      background: linear-gradient(135deg, #3b82f6, #2563eb);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.3rem;
      color: #fff;
    }
    .ai-chat-header .ai-info h5 {
      margin: 0;
      font-size: 1rem;
      color: #fff;
      font-weight: 600;
    }
    .ai-chat-header .ai-info span {
      font-size: 0.8rem;
      color: #10b981;
    }
    .ai-chat-header .ai-info span::before {
      content: '';
      display: inline-block;
      width: 7px;
      height: 7px;
      background: #10b981;
      border-radius: 50%;
      margin-right: 5px;
      vertical-align: middle;
    }
    .ai-chat-messages {
      flex: 1;
      overflow-y: auto;
      padding: 20px 24px;
      display: flex;
      flex-direction: column;
      gap: 16px;
      scroll-behavior: smooth;
    }
    .ai-chat-messages::-webkit-scrollbar {
      width: 6px;
    }
    .ai-chat-messages::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.15);
      border-radius: 3px;
    }
    .chat-message {
      display: flex;
      gap: 10px;
      max-width: 85%;
      animation: msgFadeIn 0.3s ease;
    }
    @keyframes msgFadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .chat-message.ai {
      align-self: flex-start;
    }
    .chat-message.user {
      align-self: flex-end;
      flex-direction: row-reverse;
    }
    .chat-msg-avatar {
      width: 32px;
      height: 32px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.85rem;
      flex-shrink: 0;
      margin-top: 2px;
    }
    .chat-message.ai .chat-msg-avatar {
      background: linear-gradient(135deg, #3b82f6, #2563eb);
      color: #fff;
    }
    .chat-message.user .chat-msg-avatar {
      background: rgba(255, 255, 255, 0.12);
      color: #e2e8f0;
    }
    .chat-bubble {
      padding: 12px 16px;
      border-radius: 14px;
      font-size: 0.92rem;
      line-height: 1.6;
    }
    .chat-message.ai .chat-bubble {
      background: rgba(255, 255, 255, 0.06);
      border: 1px solid rgba(255, 255, 255, 0.08);
      color: #e2e8f0;
      border-top-left-radius: 4px;
    }
    .chat-message.user .chat-bubble {
      background: linear-gradient(135deg, #3b82f6, #60a5fa);
      color: #fff;
      border-top-right-radius: 4px;
    }
    .chat-bubble b, .chat-bubble strong {
      color: #93c5fd;
    }
    .chat-bubble u {
      text-decoration-color: #60a5fa;
    }
    .quick-suggestions {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      padding: 0 24px 12px;
    }
    .quick-chip {
      background: rgba(59, 130, 246, 0.12);
      border: 1px solid rgba(59, 130, 246, 0.3);
      color: #93c5fd;
      padding: 6px 14px;
      border-radius: 20px;
      font-size: 0.82rem;
      cursor: pointer;
      transition: all 0.2s;
      white-space: nowrap;
    }
    .quick-chip:hover {
      background: rgba(59, 130, 246, 0.25);
      color: #bfdbfe;
      border-color: rgba(59, 130, 246, 0.5);
    }
    .ai-chat-input-area {
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      padding: 14px 20px;
      display: flex;
      gap: 10px;
      align-items: center;
      background: rgba(26, 26, 46, 0.5);
    }
    .ai-chat-input {
      flex: 1;
      background: rgba(255, 255, 255, 0.06) !important;
      border: 1px solid rgba(255, 255, 255, 0.12) !important;
      color: #fff !important;
      border-radius: 12px !important;
      padding: 12px 18px !important;
      font-size: 0.92rem;
      transition: all 0.2s;
    }
    .ai-chat-input:focus {
      background: rgba(26, 26, 46, 0.8) !important;
      border-color: #2563eb !important;
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15) !important;
      outline: none !important;
    }
    .ai-chat-input::placeholder {
      color: #94a3b8 !important;
    }
    .ai-send-btn {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      background: linear-gradient(135deg, #3b82f6, #60a5fa);
      border: none;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.2s;
      flex-shrink: 0;
    }
    .ai-send-btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }
    .ai-send-btn:disabled {
      opacity: 0.5;
      cursor: not-allowed;
      transform: none;
    }
    .typing-indicator {
      display: flex;
      gap: 4px;
      padding: 8px 0;
    }
    .typing-indicator span {
      width: 8px;
      height: 8px;
      background: #60a5fa;
      border-radius: 50%;
      animation: typingBounce 1.4s infinite;
    }
    .typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
    .typing-indicator span:nth-child(3) { animation-delay: 0.4s; }
    @keyframes typingBounce {
      0%, 60%, 100% { transform: translateY(0); opacity: 0.4; }
      30% { transform: translateY(-8px); opacity: 1; }
    }
    .ai-action-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 24px;
      border-top: 1px solid rgba(255, 255, 255, 0.06);
      background: rgba(26, 26, 46, 0.3);
    }
    .ai-action-bar .note-text {
      font-size: 0.78rem;
      color: #94a3b8;
    }
    .ai-action-bar .note-text i {
      color: #f59e0b;
    }
    .btn-submit-tech {
      background: rgba(239, 68, 68, 0.12);
      border: 1px solid rgba(239, 68, 68, 0.3);
      color: #fca5a5;
      padding: 6px 16px;
      border-radius: 8px;
      font-size: 0.82rem;
      cursor: pointer;
      transition: all 0.2s;
    }
    .btn-submit-tech:hover {
      background: rgba(239, 68, 68, 0.2);
      color: #fecaca;
    }
    .welcome-card {
      text-align: center;
      padding: 30px 20px;
    }
    .welcome-card .welcome-icon {
      width: 64px;
      height: 64px;
      background: linear-gradient(135deg, #3b82f6, #2563eb);
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.8rem;
      color: #fff;
      margin: 0 auto 16px;
    }
    .welcome-card h5 {
      color: #fff;
      margin-bottom: 8px;
    }
    .welcome-card p {
      color: #94a3b8;
      font-size: 0.9rem;
      max-width: 400px;
      margin: 0 auto;
    }
    .stats-row {
      display: flex;
      gap: 16px;
      margin-bottom: 24px;
    }
    .stat-card {
      flex: 1;
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 14px;
      padding: 20px;
      text-align: center;
      transition: all 0.2s;
    }
    .stat-card:hover {
      background: rgba(255, 255, 255, 0.06);
      transform: translateY(-2px);
    }
    .stat-card .stat-icon {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 10px;
      font-size: 1.2rem;
    }
    .stat-card .stat-value {
      font-size: 1.5rem;
      font-weight: 700;
      color: #fff;
      margin-bottom: 2px;
    }
    .stat-card .stat-label {
      font-size: 0.78rem;
      color: #94a3b8;
    }
  </style>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index" class="text-nowrap logo-img">
            <img src="../assets/images/logos/dark-logo.svg" width="180" alt="" class="logo-invert" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->

        <?php include('doctor-menu.php'); ?>

        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
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
      <!--  Header End -->
      <div class="container-fluid">
        <!-- Stats Row -->
        <div class="stats-row mt-4">
          <div class="stat-card">
            <div class="stat-icon" style="background: rgba(59, 130, 246, 0.15); color: #60a5fa;">
              <i class="ti ti-article"></i>
            </div>
            <div class="stat-value" id="statPending">--</div>
            <div class="stat-label">Pending Requests</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon" style="background: rgba(16, 185, 129, 0.15); color: #34d399;">
              <i class="ti ti-tool"></i>
            </div>
            <div class="stat-value" id="statTroubleshoot">--</div>
            <div class="stat-label">Troubleshooting</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon" style="background: rgba(245, 158, 11, 0.15); color: #fbbf24;">
              <i class="ti ti-checklist"></i>
            </div>
            <div class="stat-value" id="statMaintained">--</div>
            <div class="stat-label">Maintained</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon" style="background: rgba(236, 72, 153, 0.15); color: #f472b6;">
              <i class="ti ti-robot"></i>
            </div>
            <div class="stat-value" id="statAiResolved">0</div>
            <div class="stat-label">AI Assisted</div>
          </div>
        </div>

        <!-- AI Chat Section -->
        <div class="row">
          <div class="col-lg-12">
            <div class="ai-chat-container">
              <!-- Chat Header -->
              <div class="ai-chat-header">
                <div class="ai-avatar">
                  <i class="ti ti-robot"></i>
                </div>
                <div class="ai-info">
                  <h5>MediFix AI Assistant</h5>
                  <span>Online - Equipment Troubleshooting</span>
                </div>
              </div>

              <!-- Chat Messages -->
              <div class="ai-chat-messages" id="chatMessages">
                <!-- Welcome Card -->
                <div class="welcome-card" id="welcomeCard">
                  <div class="welcome-icon">
                    <i class="ti ti-stethoscope"></i>
                  </div>
                  <h5>Equipment Troubleshooting Assistant</h5>
                  <p>Describe the equipment issue you're experiencing. I'll help you troubleshoot before submitting to a technician.</p>
                </div>
              </div>

              <!-- Quick Suggestions -->
              <div class="quick-suggestions" id="quickSuggestions">
                <span class="quick-chip" onclick="sendQuickQuery(this)">Ventilator alarm not working</span>
                <span class="quick-chip" onclick="sendQuickQuery(this)">X-Ray machine no display</span>
                <span class="quick-chip" onclick="sendQuickQuery(this)">Infusion pump leaking</span>
                <span class="quick-chip" onclick="sendQuickQuery(this)">Patient monitor frozen screen</span>
                <span class="quick-chip" onclick="sendQuickQuery(this)">Defibrillator won't charge</span>
              </div>

              <!-- Action Bar -->
              <div class="ai-action-bar">
                <span class="note-text"><i class="ti ti-alert-triangle"></i> AI suggestions are for guidance only. Always verify with proper protocols.</span>
                <button class="btn-submit-tech" id="submitTechBtn" style="display:none;" onclick="submitToTechnician()">
                  <i class="ti ti-send"></i> Submit to Technician
                </button>
              </div>

              <!-- Input Area -->
              <div class="ai-chat-input-area">
                <input type="text" class="form-control ai-chat-input" id="chatInput" placeholder="Describe the equipment issue (e.g., Anesthesia machine making unusual noise)..." autocomplete="off">
                <button class="ai-send-btn" id="sendBtn" onclick="sendMessage()">
                  <i class="ti ti-send"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="py-6 px-6 text-center">
        <img src="../assets/images/logos/dark-logo.svg" width="180" alt="" class="logo-invert" />
        <br><br>
        <p class="mb-0 fs-4"><b>Logged in as a <?php echo $_SESSION['hbUser_Type']; ?>, <?php echo $_SESSION['hbUser_Name']; ?></b></p>
        <p class="mb-0 fs-4">Designed and Developed by Jemima</p>
      </div>
    </div>
  </div>
  </div>

  <script>
    // ===== AI Chat Logic =====
    const chatMessages = document.getElementById('chatMessages');
    const chatInput = document.getElementById('chatInput');
    const sendBtn = document.getElementById('sendBtn');
    const welcomeCard = document.getElementById('welcomeCard');
    const quickSuggestions = document.getElementById('quickSuggestions');
    const submitTechBtn = document.getElementById('submitTechBtn');
    let messageCount = 0;
    let aiResolvedCount = 0;
    let lastQuery = '';

    // Chat conversation history for context
    let conversationHistory = [
      {
        role: 'system',
        content: `You are a helpful technical assistant for hospital/medical equipment troubleshooting. Your role is to help doctors and medical staff diagnose and fix common equipment issues BEFORE they need to call a technician.

When the user describes an equipment issue, provide your response in this format:
<b><u>Potential Cause</u></b><br> [List possible causes]<br><br>
<b><u>Quick Fix Steps</u></b><br> [Step-by-step troubleshooting actions the doctor can try]<br><br>
<b><u>When to Call a Technician</u></b><br> [Conditions where professional help is needed]

Use HTML formatting. Be professional, concise but thorough. Focus on actionable steps. If the issue is not related to medical equipment, politely advise them to rephrase focusing on equipment issues.`
      }
    ];

    // Enter key to send
    chatInput.addEventListener('keypress', (e) => {
      if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendMessage();
      }
    });

    function sendQuickQuery(chip) {
      chatInput.value = chip.textContent;
      sendMessage();
    }

    function addMessage(text, sender) {
      // Remove welcome card on first message
      if (welcomeCard) {
        welcomeCard.remove();
      }

      const msgDiv = document.createElement('div');
      msgDiv.className = `chat-message ${sender}`;

      const avatar = document.createElement('div');
      avatar.className = 'chat-msg-avatar';
      avatar.innerHTML = sender === 'ai' ? '<i class="ti ti-robot"></i>' : '<i class="ti ti-user"></i>';

      const bubble = document.createElement('div');
      bubble.className = 'chat-bubble';

      if (sender === 'ai') {
        bubble.innerHTML = text
          .replace(/\*\*(.*?)\*\*/g, '<b>$1</b>')
          .replace(/\n/g, '<br>');
      } else {
        bubble.textContent = text;
      }

      msgDiv.appendChild(avatar);
      msgDiv.appendChild(bubble);
      chatMessages.appendChild(msgDiv);
      chatMessages.scrollTop = chatMessages.scrollHeight;

      return bubble;
    }

    function showTypingIndicator() {
      const msgDiv = document.createElement('div');
      msgDiv.className = 'chat-message ai';
      msgDiv.id = 'typingMsg';

      const avatar = document.createElement('div');
      avatar.className = 'chat-msg-avatar';
      avatar.innerHTML = '<i class="ti ti-robot"></i>';

      const bubble = document.createElement('div');
      bubble.className = 'chat-bubble';
      bubble.innerHTML = '<div class="typing-indicator"><span></span><span></span><span></span></div>';

      msgDiv.appendChild(avatar);
      msgDiv.appendChild(bubble);
      chatMessages.appendChild(msgDiv);
      chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function removeTypingIndicator() {
      const typing = document.getElementById('typingMsg');
      if (typing) typing.remove();
    }

    async function sendMessage() {
      const query = chatInput.value.trim();
      if (!query) return;

      lastQuery = query;
      messageCount++;

      // Hide quick suggestions after first message
      if (messageCount === 1) {
        quickSuggestions.style.display = 'none';
      }

      // Show "Submit to Technician" button after first interaction
      submitTechBtn.style.display = 'inline-block';

      // Add user message
      addMessage(query, 'user');
      chatInput.value = '';
      chatInput.disabled = true;
      sendBtn.disabled = true;

      // Add to conversation
      conversationHistory.push({ role: 'user', content: query });

      // Show typing indicator
      showTypingIndicator();

      try {
        const response = await fetch('ai-proxy.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            model: 'gpt-3.5-turbo',
            messages: conversationHistory
          })
        });

        const data = await response.json();
        const reply = data.choices?.[0]?.message?.content?.trim() || 'I apologize, I could not process your request at this moment. Please try again or submit to a technician for assistance.';

        removeTypingIndicator();
        addMessage(reply, 'ai');

        // Add AI response to conversation history
        conversationHistory.push({ role: 'assistant', content: reply });

        // Update AI assisted count
        aiResolvedCount++;
        document.getElementById('statAiResolved').textContent = aiResolvedCount;

      } catch (error) {
        removeTypingIndicator();
        addMessage('<span style="color: #fca5a5;">Unable to connect to AI service. Please check your connection and try again, or submit to a technician directly.</span>', 'ai');
        console.error('AI fetch error:', error);
      } finally {
        chatInput.disabled = false;
        sendBtn.disabled = false;
        chatInput.focus();
      }
    }

    function submitToTechnician() {
      if (lastQuery) {
        // Redirect to job request submission with the last query as context
        if (confirm('Are you sure you want to submit this issue to a technician for review?')) {
          window.location.href = 'job-requests?ai_assisted=true&issue=' + encodeURIComponent(lastQuery);
        }
      } else {
        alert('Please describe your equipment issue first before submitting to a technician.');
      }
    }

    // ===== Load Dashboard Stats =====
    async function loadStats() {
      try {
        const resp = await fetch('server.php?getDoctorStats=true', { signal: AbortSignal.timeout(3000) });
        if (resp.ok) {
          const stats = await resp.json();
          document.getElementById('statPending').textContent = stats.pending || 0;
          document.getElementById('statTroubleshoot').textContent = stats.troubleshoot || 0;
          document.getElementById('statMaintained').textContent = stats.maintained || 0;
        }
      } catch(e) {
        // Show 0 instead of -- if endpoint not available
        document.getElementById('statPending').textContent = '0';
        document.getElementById('statTroubleshoot').textContent = '0';
        document.getElementById('statMaintained').textContent = '0';
      }
    }
    loadStats();
  </script>

  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
<script src="../assets/js/theme-toggle.js"></script>
</body>

</html>