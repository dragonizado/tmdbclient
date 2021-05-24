<template>
    <div class="card">
        <div class="card-body">
            <h4>Advanced</h4>
            <hr>
            <form :action="formaction" method="get">
                <div class="form-group">
                    <input  class="form-control mr-sm-2" type="search" :name="searchByName" v-model="form.name" aria-label="Search" placeholder="Search Movie">
                </div>
                <div class="form-group">
                    <input  class="form-control mr-sm-2" type="search" :name="searchByDescription" v-model="form.description" aria-label="Search" placeholder="Description" >
                </div>
                <hr>
                <div class="form-group">
                    <input  class="form-control mr-sm-2" type="date" :name="searchByStartDate" v-model="form.start_date" aria-label="Search" placeholder="Description" >
                </div>
                <div class="form-group">
                    <input  class="form-control mr-sm-2" type="date" :name="searchByEndDate" v-model="form.end_date" aria-label="Search" placeholder="Description">
                </div>

                <div class="form-group">
                    <button class="btn btn-success btn-block">Search</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    mounted(){
        let query = window.location.search
        let params = new URLSearchParams(query)

        if(params.get("name") != null){
            this.form.name = params.get("name")
        }
        if(params.get("description") != null){
            this.form.description = params.get("description")
        }
        if(params.get("start_date") != null){
            this.form.start_date = params.get("start_date")
        }
        if(params.get("end_date") != null){
            this.form.end_date = params.get("end_date")
        }
    },
    data:function(){
        return {
            form:{
                name:"",
                description:"",
                start_date:"",
                end_date:""
            },
            formaction:route("site.find")
        }
    },
    computed:{
        searchByName(){
            if(this.form.name != ""){
                return "name"
            }
            return false
        },
        searchByDescription(){
            if(this.form.description != ""){
                return "description"
            }
            return false
        },
        searchByStartDate(){
            if(this.form.start_date != ""){
                return "start_date"
            }
            return false
        },
        searchByEndDate(){
            if(this.form.end_date != ""){
                return "end_date"
            }
            return false
        }
    }
}
</script>