
  const $ = document.querySelector.bind(document) // gán querySelector vào $
  const $$ = document.querySelectorAll.bind(document) // gán querySelectorAll vào $$

  const player = $('.player')
  const heading = $('header h2')
  const cdThumb = $('.cd-thumb')
  const audio = $('#audio')
  const cd = $('.cd')
  const playBtn = $('.btn-toggle-play')
  const progress = $('#progress')
  const nextBtn = $('.btn-next')
  const prevBtn = $('.btn-pre')

  const app = {
    currentIndex: 0,
    isPlaying: false,
    songs: [
    {
      name: "Bước qua nhau",
      singer: "Vũ",
      path: "./assets/music/song1.mp3",
      image: "./assets/img/song1.jpg"
    },
    {
      name: "Sài gòn đau long quá",
      singer: "Hứa Kim Tuyền",
      path: "./assets/music/song2.mp3",
      image: "./assets/img/song2.jpg"
    },
    {
      name: "Bước qua nhau",
      singer: "Vũ",
      path: "./asset/music/song1.mp4",
      image: "./assets/img/song1.jpg"
    },
    {
      name: "Sài gòn đau long quá",
      singer: "Hứa Kim Tuyền",
      path: "./assets/music/song2.mp3",
      image: "./assets/img/song2.jpg"
    }
  ],
  
    render: function () {
      const htmls = this.songs.map(song => {
                  return `<div class="song">
                <div class="thumb" style="background-image: url('${song.image}')">
                </div>
                <div class="body">
                  <h3 class="title">${song.name}</h3>
                  <p class="author">${song.singer}</p>
                </div>
                <div class="option">
                  <i class="fas fa-ellipsis-h"></i>
                </div>
              </div>`
      })
      $('.playlist').innerHTML = htmls.join(' ');
    },

    defineProperties: function() {
        Object.defineProperty(this, 'currentSong', {
          get: function() {
              return this.songs[this.currentIndex]
          }
        })
    },
    handleEvents: function () {
          const _this = this
          const cdWidth = cd.offsetWidth

          // Xử lý đĩa CD quay và dừng
          const cdThumbAnimate =  cdThumb.animate([
            {transform:'rotate(360deg'}
          ], {
             duration: 10000, // 10 seconds
             iterations: Infinity
          })
          cdThumbAnimate.pause()
          
          // Xử lý phóng to thu nhỏ CD
          document.onscroll = function() {
          
          // cách 1 console.log(window.scrollY) di chuyển đĩa nhạc đang phát nhỏ và to lại
          // cách 2 console.log(document.documentElement.scrollTop)
          const scrollTop = window.scrollY || document.documentElement.scrollTop // Toán tử hoặc
          const newCdWidth = cdWidth - scrollTop

          cd.style.width = newCdWidth > 0 ? newCdWidth + 'px' : 0
          cd.style.opacity = newCdWidth / cdWidth
        };

        // Xử lý khi click play
        playBtn.onclick = function() {
            if (_this.isPlaying) {
                audio.pause()
            } else {
                audio.play()
            }
          
        }

        // Khi song đc play 
        audio.onplay = function() {
            _this.isPlaying = true
            player.classList.add("playing")
            cdThumbAnimate.play();
        }

        // Khi song pause
        audio.onpause = function() {
            _this.isPlaying = false
            player.classList.remove("playing")
            cdThumbAnimate.pause();
        }

        // Tiến độ bài hát thay đổi
        audio.ontimeupdate = function() {
            if (audio.duration) {
              const progressPercent = Math.floor(audio.currentTime / audio.duration * 100)
              progress.value = progressPercent
            }
        }

        // Xử lý khi tua song 
        progress.onchange = function(e) {
            const seekTime = audio.duration / 100 * e.target.value;
            audio.currentTime = seekTime
        }

        // Khi Next bài hát 
        nextBtn.onclick = function() {
            _this.nextSong();
            audio.play();
        }

        // Khi Prev bài hát 
        // prevBtn.onclick = function() {
        //     _this.prevSong();
        //     audio.play();
        // }
    },

    loadCurrentSong: function () {
        heading.textContent = this.currentSong.name
        cdThumb.style.backgroundImage = `url('${this.currentSong.image}')`
        audio.src = this.currentSong.path
    },

    nextSong: function () {
      this.currentIndex++
      if(this.currentIndex >= this.songs.length) {
        this.currentIndex = 0
      }
      this.loadCurrentSong()
    },

    prevSong: function () {
      this.currentIndex--
      if(this.currentIndex < 0) {
        this.currentIndex = this.songs.length - 1
      }
      this.loadCurrentSong()
    },

    start: function () {
        // lắng nghe / xử lý các sự kiện (DOM events)
        this.handleEvents()

        // render playlist
        this.render()

        // định nghĩa các thuộc tính cho object
        this.defineProperties()

        // Tải thông tin bài hát đầu tiên vào UI khi chạy ứng dụng
        this.loadCurrentSong()
      }
  }  

    app.start()
    