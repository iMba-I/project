const loginButton = document.getElementById('login');
    const enterButtonButton = document.getElementById('enterButton');
    const startScreen_form = document.getElementById('startScreen_form');
    const login_form = document.getElementById('login_form');
    //const log = document.getElementById('login');
    const exitButton = document.getElementById('exitButton');

    loginButton.addEventListener('click', () => {
      startScreen_form.classList.toggle('active'); 
      login_form.classList.toggle('active'); 
    });
/*
    enterButtonButton.addEventListener('click', () => {
      login_form.classList.remove('active'); 
      loginButton.classList.add('hide');
      exitButton.classList.remove('hide');
      startTest_form.classList.add('active');
    });*/
    // ниже нужно сделать редирект на страницы теста/менеджера
    /*exitButton.addEventListener('click', () => {
      exitButton.classList.add('hide');
      loginButton.classList.remove('hide');
      startScreen_form.classList.toggle('active');
      mainTest_form.classList.add('hide');
      startTest_form.classList.remove('active'); 
      endTest_form.classList.add('hide');
    })*/