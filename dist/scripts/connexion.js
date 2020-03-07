if (document.querySelector('#form')) {
    var form = {
        this: document.querySelector('#form'),
        btnSubmit: document.querySelector('#form-submit'),
    
        input : {
            courriel : document.querySelector('#input-courriel'),
            password : document.querySelector('#input-password')
        }
    }
    
    console.log(form.this.parentNode);
    form.this.parentNode.addEventListener('click', (e) => {
        form.this.classList.add('form-connexion--visible');
    })
    
    
    // auto-focus formulaire
    // form.input.courriel.focus();
    
    form.this.addEventListener('submit', (e) => {
        e.preventDefault();
    
        var ajax = new ajaxRequest('POST');
        ajax.filePath('./core/controllers/authentification.php');
        ajax.addForm(form.this, form.btnSubmit);
        ajax.showError();
        ajax.addArgument({
            'action': 'connexion'
        });
        ajax.send((json) => {
            console.log(json);
            
        });
    });
}