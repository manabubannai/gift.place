export function getMessage(params) {
    return new Promise((resolve, reject) => {
        axios
            .get('/api/v1/user/messages', {
                params,
            })
            .then((res) => {
                resolve(res.data)
            })
            .catch((error) => {
                reject(error)
            })
    })
}
