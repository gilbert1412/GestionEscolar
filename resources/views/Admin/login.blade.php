<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Acceso al Sistema de Gestión Escolar">
<title>Iniciar sesión · Sistema de Gestión Escolar</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Public+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">

<style>
  :root{
    --navy-900:#17233D;
    --navy-800:#1E2E4F;
    --navy-700:#2A3F68;
    --paper:#FAF7F0;
    --paper-dim:#F1ECDF;
    --gold:#C8983F;
    --gold-light:#E0B968;
    --ink:#232A35;
    --ink-muted:#6B7280;
    --rule:#E3DCC9;
    --rule-dark:rgba(250,247,240,0.14);
  }

  *{box-sizing:border-box;}
  html,body{height:100%;}
  body{
    margin:0;
    font-family:'Public Sans', sans-serif;
    color:var(--ink);
    background:var(--paper-dim);
    -webkit-font-smoothing:antialiased;
  }

  .wrap{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:32px 20px;
  }

  .card{
    width:100%;
    max-width:960px;
    display:grid;
    grid-template-columns:1fr 1fr;
    background:var(--paper);
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 30px 60px -20px rgba(23,35,61,0.35), 0 0 0 1px rgba(23,35,61,0.04);
  }

  /* ---------- Left panel ---------- */
  .side{
    position:relative;
    background:
      repeating-linear-gradient(
        to bottom,
        transparent 0px,
        transparent 27px,
        var(--rule-dark) 27px,
        var(--rule-dark) 28px
      ),
      linear-gradient(160deg, var(--navy-900) 0%, var(--navy-800) 55%, var(--navy-700) 100%);
    color:var(--paper);
    padding:44px 40px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    min-height:640px;
  }
  .side::before{
    /* margin rule, like notebook paper */
    content:"";
    position:absolute;
    left:56px;
    top:0;
    bottom:0;
    width:1px;
    background:rgba(200,152,63,0.35);
  }

  .seal{
    width:56px;
    height:56px;
    border-radius:50%;
    border:1.5px solid var(--gold-light);
    display:flex;
    align-items:center;
    justify-content:center;
    font-family:'Fraunces', serif;
    font-weight:600;
    font-size:19px;
    letter-spacing:0.5px;
    color:var(--gold-light);
    flex-shrink:0;
    background:rgba(200,152,63,0.08);
  }

  .brand-row{
    display:flex;
    align-items:center;
    gap:14px;
    margin-bottom:56px;
  }
  .brand-name{
    font-family:'Fraunces', serif;
    font-size:15px;
    font-weight:600;
    letter-spacing:0.03em;
    line-height:1.3;
  }
  .brand-sub{
    font-size:11px;
    letter-spacing:0.14em;
    text-transform:uppercase;
    color:rgba(250,247,240,0.55);
    margin-top:2px;
  }

  .headline{
    font-family:'Fraunces', serif;
    font-weight:500;
    font-size:34px;
    line-height:1.18;
    letter-spacing:-0.01em;
    max-width:340px;
  }
  .headline em{
    font-style:italic;
    color:var(--gold-light);
  }
  .sub-copy{
    margin-top:16px;
    font-size:14.5px;
    line-height:1.6;
    color:rgba(250,247,240,0.68);
    max-width:320px;
  }

  .schedule{
    margin-top:auto;
    padding-top:36px;
    border-top:1px solid rgba(250,247,240,0.14);
  }
  .schedule-eyebrow{
    font-family:'IBM Plex Mono', monospace;
    font-size:10.5px;
    letter-spacing:0.12em;
    text-transform:uppercase;
    color:rgba(250,247,240,0.45);
    margin-bottom:12px;
  }
  .schedule-row{
    display:flex;
    justify-content:space-between;
    font-family:'IBM Plex Mono', monospace;
    font-size:12px;
    color:rgba(250,247,240,0.62);
    padding:6px 0;
    border-bottom:1px dashed rgba(250,247,240,0.12);
  }
  .schedule-row:last-child{border-bottom:none;}
  .schedule-row span:last-child{color:var(--gold-light);}

  /* ---------- Right panel ---------- */
  .form-side{
    padding:48px 44px;
    display:flex;
    flex-direction:column;
    justify-content:center;
  }

  .form-head h1{
    font-family:'Fraunces', serif;
    font-weight:600;
    font-size:26px;
    margin:0 0 6px;
    color:var(--navy-900);
  }
  .form-head p{
    margin:0 0 28px;
    font-size:13.5px;
    color:var(--ink-muted);
  }

  .role-tabs{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:8px;
    margin-bottom:26px;
  }
  .role-tab{
    position:relative;
    border:1px solid var(--rule);
    background:#fff;
    border-radius:10px;
    padding:10px 6px 9px;
    text-align:center;
    cursor:pointer;
    transition:border-color .15s ease, background .15s ease;
  }
  .role-tab input{
    position:absolute;
    inset:0;
    opacity:0;
    cursor:pointer;
    margin:0;
  }
  .role-tab .label{
    display:block;
    font-size:12.5px;
    font-weight:600;
    color:var(--ink-muted);
  }
  .role-tab .tag{
    display:block;
    font-family:'IBM Plex Mono', monospace;
    font-size:9.5px;
    letter-spacing:0.08em;
    color:#B7ADA0;
    margin-top:2px;
  }
  .role-tab:has(input:checked){
    border-color:var(--gold);
    background:rgba(200,152,63,0.07);
  }
  .role-tab:has(input:checked) .label{color:var(--navy-900);}
  .role-tab:has(input:checked) .tag{color:var(--gold);}

  .field{
    margin-bottom:20px;
  }
  .field label{
    display:block;
    font-size:11.5px;
    font-weight:600;
    letter-spacing:0.04em;
    text-transform:uppercase;
    color:var(--ink-muted);
    margin-bottom:7px;
  }
  .field-input{
    display:flex;
    align-items:center;
    gap:10px;
    border-bottom:1.5px solid var(--rule);
    padding-bottom:9px;
    transition:border-color .15s ease;
  }
  .field-input:focus-within{
    border-color:var(--gold);
  }
  .field-input svg{
    flex-shrink:0;
    color:#B7ADA0;
  }
  .field-input:focus-within svg{color:var(--gold);}
  .field-input input{
    border:none;
    outline:none;
    background:transparent;
    font-size:14.5px;
    width:100%;
    color:var(--ink);
    font-family:'Public Sans', sans-serif;
  }
  .field-input input::placeholder{color:#B7ADA0;}

  .toggle-pass{
    background:none;
    border:none;
    cursor:pointer;
    color:#B7ADA0;
    padding:0;
    display:flex;
  }
  .toggle-pass:hover{color:var(--navy-700);}

  .row-between{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin:4px 0 26px;
  }

  .remember{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:13px;
    color:var(--ink-muted);
    cursor:pointer;
  }
  .remember input{
    width:15px;
    height:15px;
    accent-color:var(--gold);
    cursor:pointer;
  }

  .link{
    font-size:13px;
    color:var(--navy-700);
    text-decoration:none;
    font-weight:600;
  }
  .link:hover{color:var(--gold);text-decoration:underline;}

  .btn-login{
    width:100%;
    padding:13px;
    border:none;
    border-radius:10px;
    background:var(--navy-900);
    color:var(--paper);
    font-size:14px;
    font-weight:600;
    letter-spacing:0.02em;
    cursor:pointer;
    transition:background .15s ease, transform .1s ease;
    font-family:'Public Sans', sans-serif;
  }
  .btn-login:hover{background:var(--navy-700);}
  .btn-login:active{transform:scale(0.99);}

  .divider{
    display:flex;
    align-items:center;
    gap:12px;
    margin:26px 0 20px;
    color:#B7ADA0;
    font-size:11.5px;
    letter-spacing:0.08em;
    text-transform:uppercase;
  }
  .divider::before,.divider::after{
    content:"";
    flex:1;
    height:1px;
    background:var(--rule);
  }

  .footnote{
    text-align:center;
    font-size:13px;
    color:var(--ink-muted);
  }
  .footnote a{color:var(--navy-700);font-weight:600;text-decoration:none;}
  .footnote a:hover{color:var(--gold);text-decoration:underline;}

  .support{
    margin-top:22px;
    text-align:center;
    font-size:11.5px;
    color:#B7ADA0;
    font-family:'IBM Plex Mono', monospace;
    letter-spacing:0.02em;
  }
  .text-danger{color:red !important;}

  @media (max-width:840px){
    .card{grid-template-columns:1fr;max-width:440px;}
    .side{min-height:auto;padding:36px 32px;}
    .schedule{margin-top:32px;}
    .form-side{padding:40px 32px;}
  }

  :focus-visible{outline:2px solid var(--gold);outline-offset:2px;}
</style>
</head>
<body>

<div class="wrap">
  <div class="card">

    <!-- Left: institutional panel -->
    <div class="side">
      <div>
        <div class="brand-row">
          <div class="seal">IE</div>
          <div>
            <div class="brand-name">Institución Educativa</div>
            <div class="brand-sub">Sistema de Gestión Escolar</div>
          </div>
        </div>

        <h2 class="headline">Bienvenido de <em>vuelta</em> al curso.</h2>
        <p class="sub-copy">Notas, asistencia, horarios y comunicados en un solo lugar para toda la comunidad educativa.</p>
      </div>

      <div class="schedule">
        <div class="schedule-eyebrow">Hoy en el sistema</div>
        <div class="schedule-row"><span>Registro de asistencia</span><span>08:00</span></div>
        <div class="schedule-row"><span>Publicación de calificaciones</span><span>11:30</span></div>
        <div class="schedule-row"><span>Reunión de padres — 3° B</span><span>17:00</span></div>
      </div>
    </div>

    <livewire:autenticacion.login />

  </div>
</div>

<script>
  const toggleBtn = document.getElementById('togglePass');
  const passInput = document.getElementById('password');
  toggleBtn.addEventListener('click', () => {
    const isPass = passInput.type === 'password';
    passInput.type = isPass ? 'text' : 'password';
    toggleBtn.setAttribute('aria-label', isPass ? 'Ocultar contraseña' : 'Mostrar contraseña');
  });
</script>

</body>
</html>