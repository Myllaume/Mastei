function Terminal() {
    this.content = document.createElement('section');
    this.messageContent = document.createElement('div');
    this.message = '';

    this.content.classList.add('d-flex', 'justify-content-center', 'terminal', 'fadein');
    this.messageContent.classList.add('terminal__content');
    this.content.appendChild(this.messageContent);
    document.body.appendChild(this.content);
}

Terminal.prototype.addMessage = function (text) {
    this.message = text;
    this.messageContent.textContent = text;
}

Terminal.prototype.addTime = function (seconds) {
    seconds = seconds * 1000;
    setTimeout(function() {
        this.content.classList.remove('fadein');
        this.content.classList.add('fadeout');
    }.bind(this)
    , seconds);
    // setTimeout(function() {
    //     this.content.remove();
    // }.bind(this)
    // , seconds + 1000);
}