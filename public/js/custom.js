function countCart() {
    axios.get('/shopCartCount').then(resp => {
        if (resp.status == 200) {
            $('#shopCart').html(resp.data);
        }
    }).catch(error => console.log(error));
}

countCart();