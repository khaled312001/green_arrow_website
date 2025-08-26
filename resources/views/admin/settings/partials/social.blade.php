<div class="setting-group">
    <h5><i class="bi bi-share"></i> روابط وسائل التواصل الاجتماعي</h5>
    <p class="text-muted">أضف روابط حساباتك الرسمية على منصات التواصل الاجتماعي</p>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="facebook_url" class="form-label">
                <i class="bi bi-facebook text-primary"></i> رابط فيسبوك
            </label>
            <input type="url" class="form-control" id="facebook_url" name="settings[facebook_url]" 
                   value="{{ $settings['social']['facebook_url'] ?? '' }}" 
                   placeholder="https://www.facebook.com/your-page">
            <div class="form-text">رابط صفحة فيسبوك الرسمية</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="twitter_url" class="form-label">
                <i class="bi bi-twitter-x text-dark"></i> رابط تويتر (X)
            </label>
            <input type="url" class="form-control" id="twitter_url" name="settings[twitter_url]" 
                   value="{{ $settings['social']['twitter_url'] ?? '' }}" 
                   placeholder="https://x.com/your-account">
            <div class="form-text">رابط حساب تويتر الرسمي</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="instagram_url" class="form-label">
                <i class="bi bi-instagram text-danger"></i> رابط انستغرام
            </label>
            <input type="url" class="form-control" id="instagram_url" name="settings[instagram_url]" 
                   value="{{ $settings['social']['instagram_url'] ?? '' }}" 
                   placeholder="https://www.instagram.com/your-account">
            <div class="form-text">رابط حساب انستغرام الرسمي</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="youtube_url" class="form-label">
                <i class="bi bi-youtube text-danger"></i> رابط يوتيوب
            </label>
            <input type="url" class="form-control" id="youtube_url" name="settings[youtube_url]" 
                   value="{{ $settings['social']['youtube_url'] ?? '' }}" 
                   placeholder="https://www.youtube.com/@your-channel">
            <div class="form-text">رابط قناة يوتيوب الرسمية</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="linkedin_url" class="form-label">
                <i class="bi bi-linkedin text-primary"></i> رابط لينكد إن
            </label>
            <input type="url" class="form-control" id="linkedin_url" name="settings[linkedin_url]" 
                   value="{{ $settings['social']['linkedin_url'] ?? '' }}" 
                   placeholder="https://www.linkedin.com/company/your-company">
            <div class="form-text">رابط صفحة لينكد إن الرسمية</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="tiktok_url" class="form-label">
                <i class="bi bi-tiktok text-dark"></i> رابط تيك توك
            </label>
            <input type="url" class="form-control" id="tiktok_url" name="settings[tiktok_url]" 
                   value="{{ $settings['social']['tiktok_url'] ?? '' }}" 
                   placeholder="https://www.tiktok.com/@your-account">
            <div class="form-text">رابط حساب تيك توك الرسمي</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="telegram_url" class="form-label">
                <i class="bi bi-telegram text-primary"></i> رابط تليجرام
            </label>
            <input type="url" class="form-control" id="telegram_url" name="settings[telegram_url]" 
                   value="{{ $settings['social']['telegram_url'] ?? '' }}" 
                   placeholder="https://t.me/your-channel">
            <div class="form-text">رابط قناة تليجرام الرسمية</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="snapchat_url" class="form-label">
                <i class="bi bi-snapchat text-warning"></i> رابط سناب شات
            </label>
            <input type="url" class="form-control" id="snapchat_url" name="settings[snapchat_url]" 
                   value="{{ $settings['social']['snapchat_url'] ?? '' }}" 
                   placeholder="https://www.snapchat.com/add/your-account">
            <div class="form-text">رابط حساب سناب شات الرسمي</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="google_maps_url" class="form-label">
                <i class="bi bi-geo-alt text-success"></i> رابط خرائط جوجل
            </label>
            <input type="url" class="form-control" id="google_maps_url" name="settings[google_maps_url]" 
                   value="{{ $settings['social']['google_maps_url'] ?? '' }}" 
                   placeholder="https://www.google.com/maps?q=your-location">
            <div class="form-text">رابط موقع الأكاديمية على خرائط جوجل</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="discord_url" class="form-label">
                <i class="bi bi-discord text-primary"></i> رابط ديسكورد
            </label>
            <input type="url" class="form-control" id="discord_url" name="settings[discord_url]" 
                   value="{{ $settings['social']['discord_url'] ?? '' }}" 
                   placeholder="https://discord.gg/your-server">
            <div class="form-text">رابط سيرفر ديسكورد</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="twitch_url" class="form-label">
                <i class="bi bi-twitch text-danger"></i> رابط تويتش
            </label>
            <input type="url" class="form-control" id="twitch_url" name="settings[twitch_url]" 
                   value="{{ $settings['social']['twitch_url'] ?? '' }}" 
                   placeholder="https://www.twitch.tv/your-channel">
            <div class="form-text">رابط قناة تويتش</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="pinterest_url" class="form-label">
                <i class="bi bi-pinterest text-danger"></i> رابط بينتريست
            </label>
            <input type="url" class="form-control" id="pinterest_url" name="settings[pinterest_url]" 
                   value="{{ $settings['social']['pinterest_url'] ?? '' }}" 
                   placeholder="https://www.pinterest.com/your-account">
            <div class="form-text">رابط حساب بينتريست</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="reddit_url" class="form-label">
                <i class="bi bi-reddit text-warning"></i> رابط ريديت
            </label>
            <input type="url" class="form-control" id="reddit_url" name="settings[reddit_url]" 
                   value="{{ $settings['social']['reddit_url'] ?? '' }}" 
                   placeholder="https://www.reddit.com/r/your-subreddit">
            <div class="form-text">رابط صفحة ريديت</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="github_url" class="form-label">
                <i class="bi bi-github text-dark"></i> رابط جيت هب
            </label>
            <input type="url" class="form-control" id="github_url" name="settings[github_url]" 
                   value="{{ $settings['social']['github_url'] ?? '' }}" 
                   placeholder="https://github.com/your-username">
            <div class="form-text">رابط حساب جيت هب</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="medium_url" class="form-label">
                <i class="bi bi-medium text-dark"></i> رابط ميديوم
            </label>
            <input type="url" class="form-control" id="medium_url" name="settings[medium_url]" 
                   value="{{ $settings['social']['medium_url'] ?? '' }}" 
                   placeholder="https://medium.com/@your-username">
            <div class="form-text">رابط حساب ميديوم</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="behance_url" class="form-label">
                <i class="bi bi-behance text-primary"></i> رابط بيهانس
            </label>
            <input type="url" class="form-control" id="behance_url" name="settings[behance_url]" 
                   value="{{ $settings['social']['behance_url'] ?? '' }}" 
                   placeholder="https://www.behance.net/your-account">
            <div class="form-text">رابط حساب بيهانس</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="dribbble_url" class="form-label">
                <i class="bi bi-dribbble text-danger"></i> رابط دريببل
            </label>
            <input type="url" class="form-control" id="dribbble_url" name="settings[dribbble_url]" 
                   value="{{ $settings['social']['dribbble_url'] ?? '' }}" 
                   placeholder="https://dribbble.com/your-account">
            <div class="form-text">رابط حساب دريببل</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="spotify_url" class="form-label">
                <i class="bi bi-spotify text-success"></i> رابط سبوتيفاي
            </label>
            <input type="url" class="form-control" id="spotify_url" name="settings[spotify_url]" 
                   value="{{ $settings['social']['spotify_url'] ?? '' }}" 
                   placeholder="https://open.spotify.com/artist/your-id">
            <div class="form-text">رابط حساب سبوتيفاي</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="apple_music_url" class="form-label">
                <i class="bi bi-apple text-dark"></i> رابط آبل ميوزك
            </label>
            <input type="url" class="form-control" id="apple_music_url" name="settings[apple_music_url]" 
                   value="{{ $settings['social']['apple_music_url'] ?? '' }}" 
                   placeholder="https://music.apple.com/artist/your-id">
            <div class="form-text">رابط حساب آبل ميوزك</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="soundcloud_url" class="form-label">
                <i class="bi bi-soundcloud text-warning"></i> رابط ساوند كلاود
            </label>
            <input type="url" class="form-control" id="soundcloud_url" name="settings[soundcloud_url]" 
                   value="{{ $settings['social']['soundcloud_url'] ?? '' }}" 
                   placeholder="https://soundcloud.com/your-account">
            <div class="form-text">رابط حساب ساوند كلاود</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="vimeo_url" class="form-label">
                <i class="bi bi-vimeo text-primary"></i> رابط فيمييو
            </label>
            <input type="url" class="form-control" id="vimeo_url" name="settings[vimeo_url]" 
                   value="{{ $settings['social']['vimeo_url'] ?? '' }}" 
                   placeholder="https://vimeo.com/your-account">
            <div class="form-text">رابط حساب فيمييو</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="flickr_url" class="form-label">
                <i class="bi bi-flickr text-danger"></i> رابط فليكر
            </label>
            <input type="url" class="form-control" id="flickr_url" name="settings[flickr_url]" 
                   value="{{ $settings['social']['flickr_url'] ?? '' }}" 
                   placeholder="https://www.flickr.com/photos/your-account">
            <div class="form-text">رابط حساب فليكر</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="quora_url" class="form-label">
                <i class="bi bi-quora text-danger"></i> رابط كورا
            </label>
            <input type="url" class="form-control" id="quora_url" name="settings[quora_url]" 
                   value="{{ $settings['social']['quora_url'] ?? '' }}" 
                   placeholder="https://www.quora.com/profile/your-account">
            <div class="form-text">رابط حساب كورا</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="stack_overflow_url" class="form-label">
                <i class="bi bi-stack-overflow text-warning"></i> رابط ستاك أوفرفلو
            </label>
            <input type="url" class="form-control" id="stack_overflow_url" name="settings[stack_overflow_url]" 
                   value="{{ $settings['social']['stack_overflow_url'] ?? '' }}" 
                   placeholder="https://stackoverflow.com/users/your-id">
            <div class="form-text">رابط حساب ستاك أوفرفلو</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="wordpress_url" class="form-label">
                <i class="bi bi-wordpress text-primary"></i> رابط ووردبريس
            </label>
            <input type="url" class="form-control" id="wordpress_url" name="settings[wordpress_url]" 
                   value="{{ $settings['social']['wordpress_url'] ?? '' }}" 
                   placeholder="https://your-blog.wordpress.com">
            <div class="form-text">رابط مدونة ووردبريس</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="blogger_url" class="form-label">
                <i class="bi bi-blogger text-warning"></i> رابط بلوجر
            </label>
            <input type="url" class="form-control" id="blogger_url" name="settings[blogger_url]" 
                   value="{{ $settings['social']['blogger_url'] ?? '' }}" 
                   placeholder="https://your-blog.blogspot.com">
            <div class="form-text">رابط مدونة بلوجر</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="tumblr_url" class="form-label">
                <i class="bi bi-tumblr text-dark"></i> رابط تمبلر
            </label>
            <input type="url" class="form-control" id="tumblr_url" name="settings[tumblr_url]" 
                   value="{{ $settings['social']['tumblr_url'] ?? '' }}" 
                   placeholder="https://your-blog.tumblr.com">
            <div class="form-text">رابط مدونة تمبلر</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="xing_url" class="form-label">
                <i class="bi bi-xing text-success"></i> رابط زينج
            </label>
            <input type="url" class="form-control" id="xing_url" name="settings[xing_url]" 
                   value="{{ $settings['social']['xing_url'] ?? '' }}" 
                   placeholder="https://www.xing.com/profile/your-account">
            <div class="form-text">رابط حساب زينج</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="skype_username" class="form-label">
                <i class="bi bi-skype text-primary"></i> اسم مستخدم سكايب
            </label>
            <input type="text" class="form-control" id="skype_username" name="settings[skype_username]" 
                   value="{{ $settings['social']['skype_username'] ?? '' }}" 
                   placeholder="your-skype-username">
            <div class="form-text">اسم المستخدم في سكايب</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="wechat_url" class="form-label">
                <i class="bi bi-wechat text-success"></i> رابط وي تشات
            </label>
            <input type="url" class="form-control" id="wechat_url" name="settings[wechat_url]" 
                   value="{{ $settings['social']['wechat_url'] ?? '' }}" 
                   placeholder="https://wechat.com/your-account">
            <div class="form-text">رابط حساب وي تشات</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="line_url" class="form-label">
                <i class="bi bi-line text-success"></i> رابط لاين
            </label>
            <input type="url" class="form-control" id="line_url" name="settings[line_url]" 
                   value="{{ $settings['social']['line_url'] ?? '' }}" 
                   placeholder="https://line.me/ti/p/@your-account">
            <div class="form-text">رابط حساب لاين</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="kakao_url" class="form-label">
                <i class="bi bi-kakao text-warning"></i> رابط كاكاو
            </label>
            <input type="url" class="form-control" id="kakao_url" name="settings[kakao_url]" 
                   value="{{ $settings['social']['kakao_url'] ?? '' }}" 
                   placeholder="https://story.kakao.com/your-account">
            <div class="form-text">رابط حساب كاكاو</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="naver_url" class="form-label">
                <i class="bi bi-naver text-success"></i> رابط نافير
            </label>
            <input type="url" class="form-control" id="naver_url" name="settings[naver_url]" 
                   value="{{ $settings['social']['naver_url'] ?? '' }}" 
                   placeholder="https://blog.naver.com/your-account">
            <div class="form-text">رابط حساب نافير</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="baidu_url" class="form-label">
                <i class="bi bi-baidu text-primary"></i> رابط بايدو
            </label>
            <input type="url" class="form-control" id="baidu_url" name="settings[baidu_url]" 
                   value="{{ $settings['social']['baidu_url'] ?? '' }}" 
                   placeholder="https://tieba.baidu.com/home/main?un=your-account">
            <div class="form-text">رابط حساب بايدو</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="qq_url" class="form-label">
                <i class="bi bi-qq text-primary"></i> رابط كيو كيو
            </label>
            <input type="url" class="form-control" id="qq_url" name="settings[qq_url]" 
                   value="{{ $settings['social']['qq_url'] ?? '' }}" 
                   placeholder="https://user.qzone.qq.com/your-account">
            <div class="form-text">رابط حساب كيو كيو</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="weibo_url" class="form-label">
                <i class="bi bi-weibo text-danger"></i> رابط ويبو
            </label>
            <input type="url" class="form-control" id="weibo_url" name="settings[weibo_url]" 
                   value="{{ $settings['social']['weibo_url'] ?? '' }}" 
                   placeholder="https://weibo.com/your-account">
            <div class="form-text">رابط حساب ويبو</div>
        </div>
    </div>
    
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i>
        <strong>ملاحظة:</strong> تأكد من أن جميع الروابط صحيحة وتعمل بشكل جيد. سيتم عرض هذه الروابط في تذييل الموقع وفي صفحات التواصل.
    </div>
</div> 