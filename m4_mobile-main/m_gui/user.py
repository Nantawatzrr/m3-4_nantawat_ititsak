from tkinter import *
from tkinter import ttk, messagebox
import mysql.connector
from mysql.connector import errorcode

win = Tk()
win.geometry('900x520')
win.option_add('*font', 'tahoma 10')
win.option_add('*Button*background', 'lightgray')

cnx = mysql.connector.connect(user="root", password="", host="127.0.0.1", database="db_libray")
cusor = cnx.cursor()

show_columns = ['id', 'm_user', 'm_pass', 'm_name', 'm_phone']
column_widths = [4,15, 15, 15, 10]

def show_data():
    for row in tree.get_children():
        tree.delete(row)
    
    sql = 'SELECT * FROM tb_member'
    cusor.execute(sql)
    rows = cusor.fetchall()

    for idx, row in enumerate(rows , start=1):
        tree.insert('', 'end', values=[idx] + list(row))



tree = ttk.Treeview(win, columns=show_columns, show='headings', height=15)
for col, heading in zip(show_columns, ['id', 'm_user', 'm_pass', 'm_name', 'm_phone']):
    tree.heading(col, text=heading)
    tree.column(col, width=100)
tree.grid(row=0, column=0, padx=10, pady=10)

show_data()



frame = LabelFrame(win, text='เพิ่มหรือแก้ไขข้อมูล')
frame.grid(row=0, column=1, padx=10, pady=5)

def add_grid(w, r, c, cspan=1):
    w.grid(row=r, column=c, columnspan=cspan, sticky=W, padx=10, pady=5)

add_grid(Label(frame, text='รหัสผู้ใช้งาน:'), r=1, c=0)
ent_UserID = Entry(frame, width=20)
add_grid(ent_UserID, r=1, c=1, cspan=2)

add_grid(Label(frame, text='รหัสผ่าน:'), r=2, c=0)
ent_pass = Entry(frame, width=20)
add_grid(ent_pass, r=2, c=1, cspan=2)

add_grid(Label(frame, text='ชื่อผู้ใช้งาน:'), r=3, c=0)
ent_name = Entry(frame, width=20)
add_grid(ent_name, r=3, c=1, cspan=2)

add_grid(Label(frame, text='เบอร์โทรศัพท์:'), r=4, c=0)
ent_phone = Entry(frame, width=20)
add_grid(ent_phone, r=4, c=1, cspan=2)

bt_add = Button(frame, text='เพิ่ม', command=lambda: add_data())
bt_add.grid(row=5, column=2, padx=10, pady=10)

bt_update = Button(frame, text='แก้ไข', command=lambda: update_data())
bt_update.grid(row=5, column=3, padx=10, pady=10)

bt_search = Button(frame, text='ค้นหา', command=lambda: search())
bt_search.grid(row=5, column=1, padx=10, pady=10)

entries = [ent_UserID, ent_pass, ent_name, ent_phone]

frame_del = LabelFrame(win, text='ลบข้อมูล')
frame_del.grid(row=1, column=1, padx=10, pady=5, sticky=W+E)
Label(frame_del, text='รหัสพนักงาน:').pack(side=LEFT, padx=10, pady=10)
ent_id_del = Entry(frame_del, width=10)
ent_id_del.pack(side=LEFT, padx=10, pady=10)
bt_del = Button(frame_del, text='ลบ', command=lambda: delete_data())
bt_del.pack(side=LEFT, padx=10, pady=10)

def search():
    # kw = ent_ID.get()
    # sql = f"SELECT * FROM tb_member WHERE m_id = {kw}"
    # cusor.execute(sql)
    kw = ent_name.get()
    sql = f"select * from tb_member where m_name = '{kw}'"
    cusor.execute(sql)
    row = cusor.fetchone()

    if row:
        set_text_entry(ent_UserID, row[0])
        set_text_entry(ent_pass, row[1])
        set_text_entry(ent_name, row[2])
        set_text_entry(ent_phone, row[3])
    else:
        messagebox.showerror('Error', 'ไม่พบข้อมูล')

def set_text_entry(ent, text):
    ent.delete(0, END)
    ent.insert(0, text)

def get_data():
    return [ent.get() for ent in entries]

def add_data():
    data = get_data()
    sql = 'INSERT INTO tb_member (m_user, m_pass, m_name, m_phone) VALUES (%s, %s, %s, %s)'
    try:
        cusor.execute(sql, data[1:])
        cnx.commit()
        messagebox.showinfo('Success', 'ข้อมูลถูกบันทึกแล้ว')
        show_data()
        clear_data()
    except Exception as e:
        print(e)
        messagebox.showerror('Error', 'เกิดข้อผิดพลาด ข้อมูลไม่ถูกบันทึก')

def update_data():
    data = get_data()
    sql = 'UPDATE tb_members SET m_user = %s, m_pass = %s, m_name = %s, m_phone = %s WHERE id = %s'
    try:
        cusor.execute(sql, data[1:] + [data[0]])
        cnx.commit()
        messagebox.showinfo('Success', 'ข้อมูลถูกอัปเดตแล้ว')
        show_data()
        clear_data()
    except Exception as e:
        print(e)
        messagebox.showerror('Error', 'เกิดข้อผิดพลาด ข้อมูลไม่ถูกอัปเดต')

def delete_data():
    id = ent_id_del.get()
    sql = 'DELETE FROM tb_member WHERE m_id = %s'
    try:
        cusor.execute(sql, [id])
        cnx.commit()
        messagebox.showinfo('Success', 'ข้อมูลถูกลบแล้ว')
        show_data()
        ent_id_del.delete(0, END)
    except Exception as e:
        print(e)
        messagebox.showerror('Error', 'เกิดข้อผิดพลาด ข้อมูลไม่ถูกลบ')

def clear_data():
    for ent in entries:
        ent.delete(0, END)

mainloop()
