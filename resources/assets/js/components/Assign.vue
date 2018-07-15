<template>
  <div>
    <a href="#" @click="testme">asdadas</a>
  </div>
</template>

<script>
  export default {
    created() {
      this.listenForChanges();
    },
    methods: {
      testme(e) {
        e.preventDefault();
        alert(1);
      },
      listenForChanges() {
        Echo.channel('posts')
          .listen('PostPublished', post => {
            if (! ('Notification' in window)) {
              alert('Web Notification is not supported');
              return;
            }

            Notification.requestPermission( permission => {
              let notification = new Notification('New post alert!', {
                body: post.title, // content for the alert
                icon: "https://pusher.com/static_logos/320x320.png" // optional image url
              });

              // link to page on clicking the notification
              notification.onclick = () => {
                window.open(window.location.href);
              };
            });
          })
        }
      } 
    }
</script>