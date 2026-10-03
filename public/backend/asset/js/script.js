const menuLi = document.querySelectorAll('.admin-sidebar-content > ul > li > a');
const subMenus = document.querySelectorAll('.sub-menu');

menuLi.forEach(item => {
    item.addEventListener('click', (e) => {
        const currentSubMenu = item.nextElementSibling; // Lấy thẻ sub-menu nằm ngay dưới thẻ a vừa click

        // Kiểm tra xem thẻ a này có menu con không
        if (currentSubMenu && currentSubMenu.classList.contains('sub-menu')) {
            e.preventDefault(); // Chặn việc load lại trang

            // Bước 1: Đóng tất cả các menu con khác đang mở 
            subMenus.forEach(menu => {
                if (menu !== currentSubMenu) {
                    menu.classList.remove('active');
                }
            });

            // Bước 2: Bật/tắt menu con của mục đang được click
            currentSubMenu.classList.toggle('active');
        }
    });
});