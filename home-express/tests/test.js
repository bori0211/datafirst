const zlib = require('zlib');

var buffer = new Buffer.from('H4sIAAAAAAAAAE1Qy27iMBT9FcsbZqSS+O04O6QybMpsYNNBqDLJhbFK7NQ27VRV/70OFdLs7HPPQ+d84AFSsifYvo+AW3y/2C6e1svNZrFa4jsc3jzEApuGCCKNZLpRBT6H0yqGy1gutX1LdexT7XzK1ndQ9zbbo4spz/tDDTGG+K3Y5Ah2KJL/CeWULofURTdmF/wvd84QE253eHhPL+flJH8Ip28c769Gy1fweeJ8YNcXPy61koQZobhSmgmtqJSNFFqThk9fbpSQVDHDmJaCiEZJyRUp2dmV+tkOpQlVhGtpeKOV0He3WYo9I4zMKZkzvSWkFbwluioURsUfxIhpGoF2v0OGPdqtH+eEEkNFeW8gvkLco8UhxAw96oL30E0lb6ocUH9o0aw/PsG/MZbAGbokiBN0m2iG/oaUC0I1qzitVKXNDP1YhYysR9d1UZm1d/5UEobh4l1nryGj7Z4hp58V/tx/fgEFlCLp5wEAAA==', 'base64');

//var buffer = new Buffer('H4sIAAAAAAAAAE1Qy27iMBT9FcsbZqSS+O04O6QybMpsYNNBqDLJhbFK7NQ27VRV/70OFdLs7HPPQ+d84AFSsifYvo+AW3y/2C6e1svNZrFa4jsc3jzEApuGCCKNZLpRBT6H0yqGy1gutX1LdexT7XzK1ndQ9zbbo4spz/tDDTGG+K3Y5Ah2KJL/CeWULofURTdmF/wvd84QE253eHhPL+flJH8Ip28c769Gy1fweeJ8YNcXPy61koQZobhSmgmtqJSNFFqThk9fbpSQVDHDmJaCiEZJyRUp2dmV+tkOpQlVhGtpeKOV0He3WYo9I4zMKZkzvSWkFbwluioURsUfxIhpGoF2v0OGPdqtH+eEEkNFeW8gvkLco8UhxAw96oL30E0lb6ocUH9o0aw/PsG/MZbAGbokiBN0m2iG/oaUC0I1qzitVKXNDP1YhYysR9d1UZm1d/5UEobh4l1nryGj7Z4hp58V/tx/fgEFlCLp5wEAAA==', 'base64');

// Calling unzip method
zlib.unzip(buffer, (err, buffer) => {
   console.log(buffer.toString('utf8'));
}); 