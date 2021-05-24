<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center">
                <div>
                    <h2>Vista previa</h2>
                </div>
                <hr>
                <movie-front-component :img="img" :title="title" :date="date"></movie-front-component>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3>Registro</h3>
                        <hr>
                        <div class="form-group">
                            <input class="form-control" type="text" v-model="title" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label for="">Cover</label>
                            <input class="form-control" type="file" name="poster_path" id="poster_path" @change="showImagePreview" placeholder="Poster">
                        </div>
                        <div class="form-group">
                            <label for="">Back</label>
                            <input class="form-control" type="file" name="backdrop_path" id="backdrop_path">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control"  placeholder="" v-model="overview" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="number" v-model="vote_count" placeholder="Vote count">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="date" title="Release date" v-model="date">
                        </div>
                        
                        <hr>
                        <button class="btn btn-success btn-block" @click="register">Register</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data:function(){
        return {
            img:"",
            title:"",
            overview:"",
            vote_count:"",
            date:""
            }
    },
    methods:{
        register(){
            let form = new FormData();

            var imagefile = document.querySelector('#poster_path');
            var backimagefile = document.querySelector('#backdrop_path');
            form.append("title",this.title);
            form.append("overview",this.overview);
            form.append("date",this.date);
            form.append("image", imagefile.files[0]);
            form.append("backdrop", backimagefile.files[0]);
            axios.post(route("site.movie.store"),form).then(response=>{
                this.clearForm()
                alert("se ha registrado correctamente")
            });
        },
        clearForm(){
            this.img = ""
            this.title = ""
            this.overview = ""
            this.date = ""
        },
        showImagePreview(){
            var imagefile = document.querySelector('#poster_path');
            let reader = new FileReader();
            reader.readAsDataURL(imagefile.files[0]);
            reader.onload = ()=>{
                this.img = reader.result
            }
        }
    }
}
</script>