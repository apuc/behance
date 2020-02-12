import asyncio
import sys
from termcolor import colored
from pyppeteer import launch

if len(sys.argv) >= 3:
    hostPort = sys.argv[1]
    url = sys.argv[2]
else:
    print(colored('No required params', 'red'))
    sys.exit()


def patch_pyppeteer():
    import pyppeteer.connection
    original_method = pyppeteer.connection.websockets.client.connect

    def new_method(*args, **kwargs):
        kwargs['ping_interval'] = None
        kwargs['ping_timeout'] = None
        return original_method(*args, **kwargs)

    pyppeteer.connection.websockets.client.connect = new_method


patch_pyppeteer()


async def main():
    browser = await launch({
        'headless': True,
        'args': [
            "--disable-gpu",
            "--disable-setuid-sandbox",
            "--force-device-scale-factor",
            "--ignore-certificate-errors",
            "--no-sandbox",
            '--proxy-server=http://' + hostPort
        ],
    })
    page = await browser.newPage()
    await page.setViewport({'width': 1200, 'height': 1080})
    await page.goto(url)

    print(1)
    await page.waitFor(1000)

    # await browser.close()


asyncio.get_event_loop().run_until_complete(main())
