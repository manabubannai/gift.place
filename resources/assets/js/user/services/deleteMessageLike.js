export function deleteMessageLike(id, formData) {
    let config = {
        headers: {
            'X-HTTP-Method-Override': 'DELETE',
        },
    }
    return new Promise((resolve, reject) => {
        // https://qiita.com/yfujii1127/items/991ae9ff29b478a55b1c
        axios.delete(`/api/v1/user/message-likes/${id}`, { data: formData }, config)  // eslint-disable-line
            .then((res) => {
                resolve(res.data)
            })
            .catch((error) => {
                reject(error)
            })
    })
}
