<div class="navbar-nav w-100 overflow-hidden" style="height: auto" id="sideBar">
    {{-- sidebar --}}
</div>


@section('navJavaScript')


<script>
    //get categories
    function getCategories(){
        axios.get('/show-all-categories').then(resp => {
            // console.log(resp);
        if(resp.status == 200) {
            resp.data.forEach((item, itemIndex) => {    
                // console.log(resp);
                $('#sideBar').append(
                    `<a href="/category/${item.cat_name.toLowerCase()}" class="nav-item nav-link">${item.cat_name}</a>`
                );     
            })
        }
        }).catch(err => {
            console.log(err)
        })
    }
    getCategories()

</script>

@endsection

{{-- '<a href="/store/'+item.cat_name.toLowerCase()+'"/"'+option.toLowerCase()+'" class="nav-item nav-link">'+option+'</a>' --}}


