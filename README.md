# NctDataEngineeringWork  

## 1. DockerDesktopのインストール  
   Dockerでの環境構築をしよう。Dockerをコマンドラインからインストールしてもいいが、MacやWindowの場合はDockerDesktopをインストールするのがいちばん簡単だと思います。[こちら](https://www.docker.com/products/docker-desktop/)からダウンロードすることが出来る。各環境でのDockerDesktopのセットアップについては各自調べてもらうといいと思う。

## 2. Docker Compose  
   Dockerを使って環境構築を行おう。以下のコマンドをディレクトリ（/NctDataEngineeringWork）の中で実行する。すると数分程度で環境構築が完了する。学校のプロキシ環境下だとうまく行かないことがあるので注意。
   ```
   docker-compose up -d
   ```

## 3. Webサーバにアクセスする。  
   [起動したWebサーバ（localhost:8080）](http://localhost:8080)にアクセスしてみよう。課題一覧が出てくるので任意のページを選択してください。
