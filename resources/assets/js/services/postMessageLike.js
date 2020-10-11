export function postMessageLike(formData) {
    return new Promise((resolve, reject) => {
        axios
            .post('/api/v1/user/message-likes', formData)
            .then((res) => {
                resolve(res.data)
            })
            .catch((error) => {
                reject(error)
            })
    })
}
