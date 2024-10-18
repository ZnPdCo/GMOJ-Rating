import requests
import urllib.parse
import sys
import base64

def login():
    """登录到竞赛网站"""
    with open('username.txt', 'r', encoding='utf-8') as f: 
        username = f.read()
    with open('password.txt', 'r', encoding='utf-8') as f: 
        password = f.read()

    data = {
        'username': username,
        'password': base64.b64decode(password).decode("utf-8")
    }
    headers = {'User-Agent': 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36'}
    url = 'https://gmoj.net/senior/index.php/main/login'
    session = requests.Session()
    session.post(url, headers=headers, data=data)
    session.keep_alive = False # 关闭多余连接
    return session

def get_description(session, username):
    headers = {'User-Agent': 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36'}
    response = session.get('https://gmoj.net/senior/index.php/users/' + urllib.parse.quote(username), headers=headers)
    if "用户名" in response.text and "下次自动登录" in response.text:
        response.close()
        return None
    if "User does not exist" in response.text:
        response.close()
        return "Wrong Username"
    """
    <dd><span class="badge badge-info">23.73%</span></dd>
    <dt class="user_specificator">Description</dt> 
    <dd><i>{description}</i></dd>
    </dl></div>
    </div>
    </fieldset></div>
    <div class="span5" id="chart-container" style="height:400px">
    """
    description = response.text.split('<dt class="user_specificator">Description</dt>')[1].split('<div class="span5" id="chart-container" style="height:400px">')[0].split('<dd><i>')[1].split('</i></dd>')[0]
    return description

description = None

while True:
    session = login()
    description = get_description(session, sys.argv[1])
    if description is not None:
        break

if(description == "Wrong Username"):
    print("Wrong Username")
elif(description.startswith('GMOJ-Rating-verify')):
    print("Ok")
else:
    print("No")