from tkinter import *
from tkinter import ttk, messagebox
import mysql.connector
from mysql.connector import errorcode

win = Tk()
win.geometry('900x520')
win.option_add('*font', 'tahoma 10')
win.option_add('*Button*background', 'lightgray')

cnx = mysql.connector.connect(user="root", password="", host="127.0.0.1", database="db_libray")
cursor = cnx.cursor()

show_columns = ['id', 'm_user', 'm_pass', 'm_name', 'm_phone', 'edit', 'deperodlete']
column_widths = [100, 100, 100, 100, 100, 130, 130]  # Adjust the column widths as needed

# Configure the style for the treeview
style = ttk.Style()
style.configure("Treeview", rowheight=25)

def show_data():
    for row in tree.get_children():
        tree.delete(row)
    
    sql = 'SELECT * FROM tb_member'
    cursor.execute(sql)
    rows = cursor.fetchall()

    for idx, row in enumerate(rows, start=1):
        edit_button = Button(tree, text='แก้ไข', command=lambda r=row[0]: edit_data(r))
        delete_button = Button(tree, text='ลบ', command=lambda r=row[0]: delete_data(r))
        tree.insert('', 'end', values=[idx] )  # Add the buttons to the end of the row

def search_data(keyword):
    if not keyword:  # If the keyword is empty, show all data
        show_data()
        return

    sql = 'SELECT * FROM tb_member WHERE m_user LIKE %s OR m_name LIKE %s'
    cursor.execute(sql, (f'%{keyword}%', f'%{keyword}%'))
    rows = cursor.fetchall()

    if not rows:
        messagebox.showinfo('ไม่พบข้อมูล', 'ไม่พบข้อมูลที่ค้นหา')
        return

    for row in tree.get_children():
        tree.delete(row)

    for idx, row in enumerate(rows, start=1):
        edit_button = Button(tree, text='แก้ไข', command=lambda r=row[0]: edit_data(r))
        delete_button = Button(tree, text='ลบ', command=lambda r=row[0]: delete_data(r))
        tree.insert('', 'end', values=[idx] + list(row) + [edit_button, delete_button])  # Add the buttons to the end of the row

def on_search():
    keyword = entry_search.get()
    search_data(keyword)

def add_member_window():
    new_window = Toplevel(win)
    new_window.title('เพิ่มข้อมูลสมาชิกใหม่')

    def add_member_action():
        username = entry_username.get()
        password = entry_password.get()
        fullname = entry_fullname.get()
        phone = entry_phone.get()

        if not username or not password or not fullname or not phone:
            messagebox.showerror('ข้อผิดพลาด', 'กรุณากรอกข้อมูลให้ครบทุกช่อง')
            return

        # Check if phone is a numeric value
        if not phone.isdigit():
            messagebox.showerror('ข้อผิดพลาด', 'กรุณากรอกเบอร์โทรศัพท์ให้เป็นตัวเลขเท่านั้น')
            return

        add_member(username, password, fullname, phone, new_window)

    # ... (existing code)

    # Labels and Entry widgets for the member data entry form
    Label(new_window, text='ชื่อผู้ใช้:').grid(row=0, column=0, padx=10, pady=5)
    entry_username = Entry(new_window, width=20)
    entry_username.grid(row=0, column=1, padx=10, pady=5)

    Label(new_window, text='รหัสผ่าน:').grid(row=1, column=0, padx=10, pady=5)
    entry_password = Entry(new_window, show='*', width=20)
    entry_password.grid(row=1, column=1, padx=10, pady=5)

    Label(new_window, text='ชื่อ-สกุล:').grid(row=2, column=0, padx=10, pady=5)
    entry_fullname = Entry(new_window, width=20)
    entry_fullname.grid(row=2, column=1, padx=10, pady=5)

    Label(new_window, text='เบอร์โทรศัพท์:').grid(row=3, column=0, padx=10, pady=5)
    entry_phone = Entry(new_window, width=20)
    entry_phone.grid(row=3, column=1, padx=10, pady=5)

    # Button for adding a new member
    Button(new_window, text='เพิ่มสมาชิก', command=add_member_action).grid(row=4, column=0, columnspan=2, pady=10)

    # Button for canceling the operation
    Button(new_window, text='ยกเลิก', command=new_window.destroy).grid(row=5, column=0, columnspan=2, pady=5)

def update_member(row_id, username, password, fullname, phone, top_level):
    try:
        # Check for duplicate username excluding the current member being edited
        check_duplicate_sql = 'SELECT COUNT(*) FROM tb_member WHERE m_user = %s AND id != %s'
        cursor.execute(check_duplicate_sql, (username, row_id))
        count = cursor.fetchone()[0]
        if count > 0:
            messagebox.showerror('ข้อผิดพลาด', 'ไม่สามารถแก้ไขข้อมูลได้ เนื่องจากมีชื่อผู้ใช้นี้แล้ว')
        else:
            # Update member data
            update_sql = 'UPDATE tb_member SET m_user = %s, m_pass = %s, m_name = %s, m_phone = %s WHERE id = %s'
            values = (username, password, fullname, phone, row_id)
            cursor.execute(update_sql, values)
            cnx.commit()
            messagebox.showinfo('แก้ไขข้อมูลสำเร็จ', 'ทำรายการสำเร็จ')
            show_data()
            top_level.destroy()
            messagebox.showinfo('แก้ไขข้อมูลสำเร็จ', 'แก้ไขข้อมูลสมาชิกเรียบร้อย')
    except Exception as e:
        messagebox.showerror('เกิดข้อผิดพลาด', f'เกิดข้อผิดพลาด: {str(e)}')

def delete_data(row_id):
    try:
        # Delete member data
        delete_sql = 'DELETE FROM tb_member WHERE id = %s'
        cursor.execute(delete_sql, (row_id,))
        cnx.commit()
        messagebox.showinfo('ลบข้อมูลสำเร็จ', 'ลบข้อมูลสมาชิกเรียบร้อย')
        show_data()
    except Exception as e:
        messagebox.showerror('เกิดข้อผิดพลาด', f'เกิดข้อผิดพลาดในการลบข้อมูล: {str(e)}')

tree = ttk.Treeview(win, columns=show_columns, show='headings', height=20)
for col, heading, width in zip(show_columns, ['ลำดับ  ', 'ชื่อผู้ใช้', 'รหัสผ่าน', 'ชื่อ-สกุล', 'เบอร์โทรศัพท์', 'แก้ไข', 'ลบ'], column_widths):
    tree.heading(col, text=heading)
    tree.column(col, width=width)

# Bind events for editing and deleting
tree.bind('<ButtonRelease-1>', lambda event: on_edit(event))  # Left-click event for editing
tree.bind('<Delete>', lambda event: on_delete(event))  # Delete key event for deleting

tree.grid(row=2, column=0, padx=10, pady=10, columnspan=3)  # Adjusted the columnspan to 3

# Frame for search
frame_search = LabelFrame(win, text='การจัดการข้อมูลสมาชิก')  # Adjusted the justify option
frame_search.grid(row=0, column=0, padx=10, pady=5, sticky=W, columnspan=3)  # Adjusted the columnspan to 3
Label(frame_search, text='ค้นหา (ชื่อผู้ใช้หรือชื่อสกุล):').grid(row=0, column=0, padx=10, pady=10)
entry_search = Entry(frame_search, width=20)
entry_search.grid(row=0, column=1, padx=10, pady=10)
Button(frame_search, text='ค้นหา', command=on_search).grid(row=0, column=2, padx=10, pady=10)

# Button for adding new member data
Button(win, text='เพิ่มข้อมูลสมาชิก', command=add_member_window).grid(row=1, column=0, padx=10, pady=10, columnspan=3)

mainloop()
