// server.js
const express = require('express');
const nodemailer = require('nodemailer');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;

app.use(bodyParser.json());
app.use(express.static('public'));

app.post('/send-email', (req, res) => {
    const { name, email, phone, date, time, people } = req.body;
    const transporter = nodemailer.createTransport({
        service: 'gmail',
        auth: {
            user: 'your-email@gmail.com',
            pass: 'your-email-password'
        }
    });

    const mailOptions = {
        from: 'your-email@gmail.com',
        to: 'creator-email@example.com',
        subject: 'Новое бронирование столика',
        text: `Имя: ${name}\nEmail: ${email}\nТелефон: ${phone}\nДата: ${date}\nВремя: ${time}\nКоличество человек: ${people}`
    };

    transporter.sendMail(mailOptions, (error, info) => {
        if (error) {
            console.log(error);
            res.status(500).send('Error');
        } else {
            console.log('Email sent: ' + info.response);
            res.status(200).send('Success');
        }
    });
});

app.listen(port, () => {
    console.log(`Server is running at http://localhost:${port}`);
});
