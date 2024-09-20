const { Client } = require('whatsapp-web.js');
const qrcode = require('qrcode-terminal');

const client = new Client();

client.on('qr', (qr) => {
    // Exibe o QR code no terminal para ser escaneado pelo WhatsApp Web
    qrcode.generate(qr, { small: true });
});

client.on('ready', () => {
    console.log('Client is ready!');

    // Enviar mensagem
    const number = "553384558906";  // Número do destinatário no formato internacional
    const message = "boa noite meu amor";
    const chatId = number + "@c.us"; // Formato esperado pelo WhatsApp

    client.sendMessage(chatId, message).then(response => {
        console.log('Mensagem enviada com sucesso!', response);
    }).catch(err => {
        console.error('Erro ao enviar mensagem:', err);
    });
});

client.initialize();
