define(function () {
    return function (id, data) {
        this.id = id;
        this.data = data;

        console.log(this.data);
    };
});