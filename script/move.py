import os,sys,shutil,pwd,grp
### copies a list of files from source. handles duplicates.
def rename(file_name, dst, num=1):
    #splits file name to add number distinction
    (file_prefix, exstension) = os.path.splitext(file_name)
    renamed = "%s(%d)%s" % (file_prefix,num,exstension)

    #checks if renamed file exists. Renames file if it does exist.
    if os.path.exists(dst + renamed):
        return rename(file_name, dst, num + 1)
    else:
        return renamed

def copy_files(src,dst,file_list):
    for files in file_list:
        src_file_path = src + files
        dst_file_path = dst + files
        if os.path.exists(dst_file_path):
	    os.remove(dst_file_path)
            #new_file_name =  rename(files, dst)
            #dst_file_path = dst + new_file_name

        print "Copying: " + dst_file_path
        try:
            shutil.copyfile(src_file_path,dst_file_path)
        except IOError:
            print src_file_path + " does not exist"
            raw_input("Please, press enter to continue.")

def read_file(file_name):
    f = open(file_name)
    #reads each line of file (f), strips out extra whitespace and 
    #returns list with each line of the file being an element of the list
    content = [x.strip() for x in f.readlines()]
    f.close()
    return content
    
src = '/home/darkbobo/Desktop/CT310/Group7/'
dst = '/var/www/html/gp2/'
file_with_list = './main_list.txt'

src1 = '/home/darkbobo/Desktop/CT310/Group7/assets/css/'
dst1 = '/var/www/html/gp2/assets/css/'
file_with_list1 = './styles_list.txt'

src2 = '/home/darkbobo/Desktop/CT310/Group7/assets/img/'
dst2 = '/var/www/html/gp2/assets/img/'
file_with_list2 = './img_list.txt'

src3 = '/home/darkbobo/Desktop/CT310/Group7/assets/users/'
dst3 = '/var/www/html/gp2/assets/users/'
file_with_list3 = './users_list.txt'

src4 = '/home/darkbobo/Desktop/CT310/Group7/inc/'
dst4 = '/var/www/html/gp2/inc/'
file_with_list4 = './inc_list.txt'

src5 = '/home/darkbobo/Desktop/CT310/Group7/lib/'
dst5 = '/var/www/html/gp2/lib/'
file_with_list5 = './lib_list.txt'

copy_files(src, dst, read_file(file_with_list))
copy_files(src1, dst1, read_file(file_with_list1))
copy_files(src2, dst2, read_file(file_with_list2))
copy_files(src3, dst3, read_file(file_with_list3))
copy_files(src4, dst4, read_file(file_with_list4))
copy_files(src5, dst5, read_file(file_with_list5))
os.system("chmod -R 777 /var/www/html/gp2/")
