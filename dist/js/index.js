const mqtt = require('mqtt');
const mysql = require('mysql');

const client = mqtt.connect({
	port: 1883,
	host:'broker.emqx.io',
	keepalive: 10000
});

var con = mysql.createConnection({
	host : "localhost",
	user : "root",
	password : "",
	database : "datasensors"
});
	con.connect(function(err) {
		if (err) throw err;
		console.log("Connected!");
});

client.subscribe('esp/hcsr04/#');
client.on('message', function (topic, payload) {
	console.log([topic, payload].join(":"));
	
	//MySQL
	con.connect(function(err){
		var record = [
			[topic, payload]
		];

		var mysql = "INSERT INTO read_sensor (topic, payload) VALUES?";
		con.query(mysql, [record], function(err, result){
			if(err) throw err;
			console.log("1 data ditambahkan");

		});
	});
});