#!/bin/sh

#
# Qiitaのtag検索からユーザーのTwitterページURLを取得
#

# 囲まれた文字のみを抽出
function tgrep() {
    # 正規表現の特殊文字をエスケープ
    escape='
        s/*/\\\*/g;
        s/+/\\\+/g;
        s/\./\\\./g;
        s/?/\\\?/g;
        s/{/\\\{/g;
        s/}/\\\}/g;
        s/(/\\\(/g;
        s/)/\\\)/g;
        s/\[/\\\[/g;
        s/\]/\\\]/g;
        s/\^/\\\^/g;
        s/|/\\\|/g;
        '
    firstWord=`echo "$1" | sed "$escape"`
    lastWord=`echo "$2" | sed "$escape"`
    ggrep -oP "(?<=$firstWord).*(?=$lastWord)"
}

function main() {
    # ページネーション番号
    local startPageNo=2
    local endPageNo=10

    # Qiitaのユーザー取得
    for pageNo in `seq $startPageNo $endPageNo`; do
        tag='vim'
        urlQiita="https://qiita.com/tags/$tag/items?page=$pageNo"
        qiitaUsers+=`curl -s $urlQiita | tr ">" "\n" | grep -A 2 "tsf-ArticleBody_author" | tgrep "href=\"" "\""`
    done

    # 重複削除
    qiitaUsers=`echo "${qiitaUsers[@]}" | sort -u`

    # Twitterアカウント取得
    for qiitaUser in ${qiitaUsers[@]}; do
        curl -s https://qiita.com$qiitaUser | tr ">" "\n" | grep https://twitter.com/ | tgrep "href=\"" "\""
    done
}

main
