const css_root = document.documentElement;
const button_background_color = getComputedStyle(css_root).getPropertyValue('--button_background_color').trim();
const button_background_color_hover = getComputedStyle(css_root).getPropertyValue('--button_background_color_hover').trim();
const button_background_color_selected = getComputedStyle(css_root).getPropertyValue('--button_background_color_selected').trim();
const button_background_color_selected_hover = getComputedStyle(css_root).getPropertyValue('--button_background_color_selected_hover').trim();

let selected_option = 0;// 0=login 1=registro

//Volta a pagina inicial com um click no titulo
document.getElementById('lbl_title_page').addEventListener('click', () => { window.location.assign("/"); })

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
});

btn_register.addEventListener('click', () => {
    selected_option = 1;
    btn_login.style.backgroundColor = button_background_color;
    btn_register.style.backgroundColor = button_background_color_selected_hover;
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

show_warning('error','Mensagem de erro');
show_warning('alert','Mensagem de alerta');
show_warning('notice','Mensagem de aviso');