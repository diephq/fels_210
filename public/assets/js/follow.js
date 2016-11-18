var Follow = function (target_id, following, token, _this, button_following, button_follow) {
    this.target_id = target_id;
    this.following = following;
    this.token = token;
    this.self = _this;
    this.button_following = button_following;
    this.button_follow = button_follow;
};

Follow.prototype = {
    init: function () {
        var _self = this;
        _self.initEvent();
    },

    initEvent: function () {
        var _self = this;
        $.ajax({
            type: "POST",
            url: "/follow_user",
            data: {
                'target_id': _self.target_id,
                '_token' : _self.token,
            },
            success: function (result) {

                var _result = JSON.stringify(result);

                if (_result == _self.following) {
                    $(_self.self).attr('value', _self.button_following);
                    $(_self.self).attr('class', 'btn-follow btn-following follow');
                } else {
                    $(_self.self).attr('value', _self.button_follow);
                    $(_self.self).attr('class', 'btn-follow btn-follow follow');
                }
            }
        });
    }

};
