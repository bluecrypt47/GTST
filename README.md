# Project GTST - Team NA

###### Start product: 4/4/2023

Sau khi Clone project về, ae connect DB như sau nhen:

1. Mở `XAMPP` lên và vào `phpmyadmin`.
2. Tạo mới 1 CSDL có tên là "`gtst`".
3. Dùng chức năng `Import` của `phpmyadmin` để import file sql có trong thư mục vừa clone.

## Các file cần lưu ý:

- File `config.php` sẽ là file để connect DB.
- File `format.php` sẽ là file để format code hoặc các input đầu vào của người dùng.
- File `database.php` để thực hiện các thao tác với DB (Select - Insert - Update - Delete).
- File `session.php` dùng để lưu session người dùng.

## Hướng dẫn up code

Khi code xong mà muốn up lên thì làm như sau:
- Tạo 1 branch mới. Cú pháp: `git branch name_branch` (VD: git branch dev).
- Vào branch vừa tạo. Cú pháp: `git checkout name_branch` (VD: git checkout dev).
- Sau khi vào thì sử dụng các lệnh git bình thường:
  - `git add name_folder`
  - `git commit -m "your commit"`
  - `git push`

Sau push thành công, nhắn gr để t merge code nhen!!!.

## Lưu ý
- Trước khi ae code thì cần `pull` code về trước.
- Khi push lên thì chỉ push những file mình sửa không sử dụng lệnh `git add .`. 