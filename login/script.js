//Volta a pagina inicial com um click no titulo
document.getElementById('lbl_title_page').addEventListener('click', () => { window.location.assign("/"); });

//Evento de click no botão de continuar
document.getElementById('btn_continue').addEventListener('click', () => { btn_continue_click(); });

const css_root = document.documentElement;
const button_background_color = getComputedStyle(css_root).getPropertyValue('--button_background_color').trim();
const button_background_color_hover = getComputedStyle(css_root).getPropertyValue('--button_background_color_hover').trim();
const button_background_color_selected = getComputedStyle(css_root).getPropertyValue('--button_background_color_selected').trim();
const button_background_color_selected_hover = getComputedStyle(css_root).getPropertyValue('--button_background_color_selected_hover').trim();

let selected_option = 0;// 0=login 1=registro

//Busca de componentes
let btn_login = document.getElementById('btn_login');
let btn_register = document.getElementById('btn_register');

//Define o login como padrão
btn_login.style.backgroundColor = button_background_color_selected;

//Jogo de eventos para indicar se o modo de login ou registro está selecionado
btn_login.addEventListener('click', () => {
    selected_option = 0;
    btn_login.style.backgroundColor = button_background_color_selected_hover;
    btn_register.style.backgroundColor = button_background_color;

    //Mostra e reseta o forgot_password
    document.getElementById('lbl_forgot_password').style.display = 'flex';
    document.getElementById('ckb_forgot_password').checked = false;
});

btn_register.addEventListener('click', () => {
    selected_option = 1;
    btn_login.style.backgroundColor = button_background_color;
    btn_register.style.backgroundColor = button_background_color_selected_hover;

    //Esconde e reseta o forgot_password
    document.getElementById('lbl_forgot_password').style.display = 'none';
    document.getElementById('ckb_forgot_password').checked = false;
});

btn_login.addEventListener('mouseenter', () => {
    if (selected_option == 0)
        btn_login.style.backgroundColor = button_background_color_selected_hover;
    else
        btn_login.style.backgroundColor = button_background_color_hover
});

btn_login.addEventListener('mouseleave', () => {
    if (selected_option == 0)
        btn_login.style.backgroundColor = button_background_color_selected;
    else
        btn_login.style.backgroundColor = button_background_color;
});

btn_register.addEventListener('mouseenter', () => {
    if (selected_option == 1)
        btn_register.style.backgroundColor = button_background_color_selected_hover;
    else
        btn_register.style.backgroundColor = button_background_color_hover
});

btn_register.addEventListener('mouseleave', () => {
    if (selected_option == 1)
        btn_register.style.backgroundColor = button_background_color_selected;
    else
        btn_register.style.backgroundColor = button_background_color;
});

show_warning('error', 'Mensagem de erro');
show_warning('alert', 'Mensagem de alerta');
show_warning('notice', 'Mensagem de aviso');

//Chama as funções do servidor por aqui
async function server(func, args = {}, disable_loading = false) {
    if (!disable_loading)
        document.body.style.cursor = "wait";

    try {
        const response = await fetch('login_manager.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                func: func, args: args
            })
        });

        if (!response.ok) {
            throw new Error('Erro HTTP: ' + response.status);
        }
        const data = await response.json();

        if (data.status !== 'success') {

            throw data;
        }

        return data;
    }
    finally {
        if (!disable_loading)
            document.body.style.cursor = "default";
    }
}


function btn_continue_click() {
    const txt_email = document.getElementById('txt_email').value;
    const txt_password = document.getElementById('txt_password').value;
    const ckb_forgot_password = document.getElementById('ckb_forgot_password').checked;

    //Validação de input
    if (!txt_email) {
        show_warning('alert', 'Insira seu e-mail.');
        return;
    }
    if (!ckb_forgot_password && !txt_password) {
        show_warning('alert', 'Insira sua senha.');
        return;
    }

    if (selected_option == 0)//Login
    {
        const args = { 'email': txt_email, 'password': txt_password, 'forgot': ckb_forgot_password };

        server('login', args)
            .then(res => {

            })
            .catch(err => {
                show_warning('error', 'Erro ao fazer o login.');
                console.error('Erro ao fazer o login:', err.message);
            })

    }
    else//Registro
    {
        const args = { 'email': txt_email, 'password': txt_password }
        server('register', args)
            .then(res => {

            })
            .catch(err => {
                show_warning('error', 'Erro ao se registrar.');
                console.error('Erro ao se registrar:', err.message);
            })
    }
}