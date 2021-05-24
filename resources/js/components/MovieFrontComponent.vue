<template>
    <div class="w-25 p-1">
        <a :href="makeUrl" @click.prevent="registerSerach">
            <img class="w-100" :src="movieImage" :alt="title">
        </a>
        <div class="text-center">
            <a :href="makeUrl">
                <h4 v-text="title"></h4>
            </a>
            <p v-text="date"></p>
        </div>
    </div>
</template>
<script>
export default {
    props:{
        id:String,
        img:String,
        title:String,
        local:String,
        date:String
    },
    computed:{
        makeUrl(){
            if(typeof this.id != "undefined" && typeof this.local != "undefined"){
                return route("site.movie.show",[this.id,this.local]);
            }
        },
        movieImage:function(){
            if(this.img != ""){
                if(this.img.includes("data:image/") || this.img.includes("http")){
                    return this.img
                }
                
                return `https://image.tmdb.org/t/p/w500${this.img}` 
            }
            return `/img/not-found.png` 
        }
    },
    methods:{
        rediretToMovie(){
            if(typeof this.id != "undefined" && typeof this.local != "undefined"){
                return route("site.movie.show",[this.id,this.local]);
            }
        }
        ,
        registerSerach(){
            if(typeof this.$attrs.rsearch != "undefined"){
                let form = new FormData();
                form.append("image",`https://image.tmdb.org/t/p/w500${this.img}`);
                form.append("title",this.title);
                form.append("date",this.date);
                form.append("overview",this.$attrs.overview);
                form.append("vote_count",this.$attrs.votecount);
                form.append("backdrop",this.$attrs.poster);
                axios.post(route("site.movie.search.store"),form).then(response=>{
                    window.location.href = this.rediretToMovie()
                })
            }else{
                window.location.href = this.rediretToMovie()
            }
        }
    }
}
</script>