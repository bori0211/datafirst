const {InfluxDB} = require('@influxdata/influxdb-client')

// You can generate a Token from the "Tokens Tab" in the UI
const token = 'AuGen9c4scgBONy9m3qRLIYFJmR9nbMeTyf6FQqze49kPhHkywV72-kUwdmrTqEix9zJgAeRgB_EgE_odLVnhQ=='
const org = 'devTeam'
const bucket = 'datafirst'

const client = new InfluxDB({url: 'http://influxdb2.datafirst.co.kr:8086', token: token})

const {Point} = require('@influxdata/influxdb-client')
const writeApi = client.getWriteApi(org, bucket)
writeApi.useDefaultTags({host: 'host1'})

const point = new Point('test-node-cli')
  .floatField('used_percent', 23.43234543)
writeApi.writePoint(point)
writeApi
    .close()
    .then(() => {
        console.log('FINISHED')
    })
    .catch(e => {
        console.error(e)
        console.log('\\nFinished ERROR')
    })
    