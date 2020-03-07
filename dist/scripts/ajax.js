function ajaxRequest(type) {
    this.request = {
        init: new XMLHttpRequest(),
        argument: {},
        data: {},
        type: '',
        filePath: '',
        completeUrl: '',
        isAsync: false,
        error: {
            show: false,
            status: undefined,
            text: ''
        }
    };

    this.form = {
        elem: undefined,
        btn: undefined,
        data: undefined
    };

    if (type == 'POST' || type == 'GET') {
        this.request.type = type;
    } else {
        this.request.error.text = 'Type de requête invalide.';
        this.throwError();
    }
}

ajaxRequest.prototype.filePath = function(filePath) {
    this.request.filePath = filePath;
    this.request.completeUrl = filePath;
}

ajaxRequest.prototype.isAsyncrone = function() {
    this.request.isAsync = true;
}

ajaxRequest.prototype.showError = function() {
    this.request.error.show = true;
}

ajaxRequest.prototype.consolLog = function() {
    console.log(this);
}

ajaxRequest.prototype.throwError = function() {
    if (this.request.error.show) {
        console.error(this.request);
    }
}

ajaxRequest.prototype.addArgument = function(object) {
    if (this.request.filePath) {
        this.request.argument = object;
        this.request.completeUrl = this.request.filePath + '?';
        for (const argument in object) {
            this.request.completeUrl += `${argument}=${object[argument]}&`
        }
        this.request.completeUrl = this.request.completeUrl.slice(0, -1);;
    } else {
        this.request.error.text = 'Chemin de fichier nécessaire.';
        this.throwError();
    }
}

ajaxRequest.prototype.addForm = function(formElem, formBtn) {

    if (this.request.type !== 'POST') {
        his.request.error.text = 'Impossible de lier à un formulaire a cette requête avec son type actuel.';
        this.throwError();
        return;
    }

    if (!formElem || !formBtn) {
        this.request.error.text = 'Il manque des éléments interactifs.';
        this.throwError();
        return;
    }
    
    this.form = {
        elem: formElem,
        btn: formBtn,
        data: new FormData(formElem)
    };
}

ajaxRequest.prototype.send = function(callback) {
    if (this.form && this.form.btn) {
        this.form.btn.disabled = true;
    }

    this.request.init.open(this.request.type, this.request.completeUrl);

    this.request.init.addEventListener('load', () => {
        this.request.error.status = this.request.init.status;
        this.request.error.text = this.request.init.statusText;

        if (this.form.btn) {
            this.form.btn.disabled = false;
        }

        if (this.request.init.status >= 200 && this.request.init.status < 400) {
            try {
                this.request.data = JSON.parse(this.request.init.responseText);
                callback(this.request.data);
            } catch {
                this.request.error.text = 'JSON intraitable !';
                this.request.error.data = this.request.data;
                this.throwError();
            }
        } else {
            this.throwError();
        }
    })

    this.request.init.addEventListener("error", function () {
        this.request.error.text = 'Erreur AJAX fatale.';
        this.throwError();
    })

    if (this.request.type == 'POST' && this.form.data) {
        this.request.init.send(this.form.data);
    } else {
        this.request.init.send();
    }
}