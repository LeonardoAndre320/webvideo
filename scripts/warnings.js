function show_warning(type, message) {

    //Traduz o tipo para titulo legivel
    let title;
    switch(type){
        case 'notice': title = 'Aviso';
        case 'alert': title = 'ALerta';
        case 'error': title = 'Erro';
        default: title = 'Aviso';
    }

    //Cria a caixa do aviso
    const box = document.createElement('div');
    box.className = 'warning_box ' + type;

    box.innerHTML = `
        <span class="warning_icon" >⚠</span>
        <div class="warning_content">
            <h3 class="warning_title">`+title+`</h3>
            <p class="warning_message">`+message+`</p>
        </div>
        <button class="warning_btn_close">X</button>
    `;

    //Evento de fechar no botão
    box.querySelector('.warning_btn_close').addEventListener('click',()=>{
        box.remove();
    })

    //Fechamento automatico em 5 segundos
    setTimeout(() => {
        box.remove();
    }, 5000);

    document.body.appendChild(box);
}