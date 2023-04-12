const clientId = 'mqttjs_' + Math.random().toString(16).substr(2, 8)

const host = 'ws://broker.emqx.io:8083/mqtt'

const options = {
    keepalive: 60,
    clientId: clientId,
    protocolId: 'MQTT',
    protocolVersion: 4,
    clean: false,
    reconnectPeriod: 1000,
    connectTimeout: 30 * 1000,

    will: {
        topic: 'esp/hcsr04',
        payload: 'Perangkat gagal terhubung..!',
        qos: 2,
        retain: false
    },
}

console.log('Menghubungkan ke broker')
const client = mqtt.connect(host, options)

client.on('error', (err) => {
    console.log('Connection error: ', err)
    client.end()
  })
  
  client.on('reconnect', () => {
    console.log('Reconnecting...')
  })
  
  client.on('connect', () => {
    console.log('Client connected:' + clientId)
    client.subscribe('esp/hcsr04', { qos: 2 })
    client.publish('esp/hcsr04', 'ws connection demo...!', { qos: 2, retain: false })
  })
  
  client.on('message', (topic, message, packet) => {
    console.log(topic)
  })
  

client.subscribe("esp/hcsr04")

client.on("message", function (topic, payload) {

    if(topic == "esp/hcsr04") {
        document.getElementById("kendaraan1").innerHTML = payload;
        nilai = parseInt(payload);
        if (nilai < 100){
            document.getElementById("kendaraan1").innerHTML = "Tidak Aman";
        } else {
            document.getElementById("kendaraan1").innerHTML = "Aman";
        }
    }

    console.log([topic, payload].join(": "))
});

//sambungan terjalin
client.on('connect', () => {
    console.log('Terhubung:' + clientId)
    document.getElementById("status").innerHTML = "Terhubung";
    document.getElementById("status").style.color = "blue";
})

//sambungan terputus
client.on('disconnect', () => {
    console.log('Terputus')
    document.getElementById("status").innerHTML = "Terputus";
    document.getElementById("status").style.color = "red";
})