<template>
    <div class="w-25 p-1">
        <a :href="makeUrl">
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
    mounted() {
        
    },
}
</script>