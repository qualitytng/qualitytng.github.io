---
title: "Cài Ubuntu cho Deep Learning"
excerpt: "Cài Ubuntu, gcc, g++,... vân vân và mây mây"
toc: true

header:
  #teaser: /assets/images/my-personal-website-th.jpg
  overlay_image:  /assets/images/my-personal-website-th.jpg
  overlay_color: "#000"
  overlay_filter: 0.6
  caption: " "

categories:
  - Ubuntu
  - Driver
  - Run

tags:
  - Ubuntu
  - Driver
  - gcc g++
  - Nvidia
---
Tại đây trình bày theo thứ tự ngược: dùng trước, cài sau, vì cài chỉ 1 lần, dùng mãi

# Run jupyter notebook on server from local

- Anaconda Jupyter Notebook: Run Remote Notebook on server from local:

    1. connect Xshell/ ssh to server.
    2. Run On server: (example: 1080ti server)

    ```bash
    conda info --envs
    source activate tf
    jupyter notebook --no-browser --ip=* --port=1234
    jupyter notebook --no-browser --ip=0.0.0.0 --port=1234  
    ```

    (port can be change)    
    result:
    `http://(ubu or 127.0.0.1):1234/?token=113fbcd684007d6a72f8839c94637951d613b136a39b040c`

    3. Run on local:
        - copy that address, paste to local browser
        - change IP address to real IP:

        `http://10.1.53.1:1234/?token=113fbcd684007d6a72f8839c94637951d613b136a39b040c`
        - Enjoy!

    4. Change jupyter notebook password: `jupyter notebook password`.

# Cài Ubuntu xong rồi => cài các thứ liên quan

- Vô cùng quan trọng:

>Yeah, currently when you install Keras using pip or pip3 it blows off existing TF and installs the default, non-GPU version. It'd be great if there was a flag to not touch existing TF.

>The workaround is to uninstall TF after installing Keras, and then installing the GPU version using pip or pip3 depending on your preferred python version. Not very elegant, but you gotta do what you gotta do.

Khi cài Keras, nó sẽ cài `tensorflow` for `CPU`, nên quy trình cài đúng là:
Nhục quá, vì cái này mà mất đứt cả tuần!
Chi tiết, [xem tại đây](https://github.com/keras-team/keras/issues/5776#issuecomment-452602358)


After: install tensorflow -> install keras -> uninstall tensorflow -> install tensorflow
and it works! Thanks a lot!
```bash
conda create -n ta  anaconda python
source activate ta
conda install tensorflow-gpu==1.11 cudatoolkit==9.0 cudnn==7.1.2 h5py
pip install pillow h5py keras
pip uninstall tensorflow
pip install tensorflow-gpu
```
```python
python
import keras.backend as K;[x.name for x in K.get_session().list_devices()]
exit()
#
git clone https://github.com/fchollet/keras.git
cd "keras/examples"
python mnist_cnn.py
```

- Code check GPU đã cài OK chưa, chạy python với lệnh sau:

```python
import keras.backend as K;[x.name for x in K.get_session().list_devices()]

from tensorflow.python.client import device_lib;device_lib.list_local_devices()
```

nếu nhìn thấy `gpu` là OK rồi.

> ấy vậy, mà mình cài mãi nó chẳng hiện lên GPU mới cay chứ. Cài server mình cài có khi đến hơn năm liên tục rồi chứ chả ít. thế mà vụ này lại dính. nguyên nhân là do hôm nọ đang training, nhìn thấy nó cập nhật version mới, ngứa tay không chịu dc, thế là update. Mất cả tuần rồi cứ tranh thủ train rồi lại cài lại. Cài lại cả driver/cuda/cudnn rồi mà vẫn không được. Chưa phát hiện nguyên nhân do cái gì. Bực cái là mạng của cái cty này nó giới hạn tốc độ mới nhục chứ. Cài 1 lần cả GB mà mạng chỉ có 400KB/s thì đến mùa quýt nào mới xong?

Cài cài này phức tạp phết

## Install Anaconda
- Install DRIVER
- Install cuda: `sudo apt-get install cuda-toolkit...`
- bash Anaconda-xxx...

    ```bash
conda create -n tt  anaconda python
source activate tt
conda install tensorflow-gpu==1.11 cudatoolkit==9.0 cudnn==7.1.2 h5py
pip install pillow h5py keras
pip uninstall tensorflow
pip install tensorflow-gpu
git clone https://github.com/fchollet/keras.git
cd keras/examples
python mnist_cnn.py
```

Cài cuda: Nên download về máy, thay tên bằng tên đã down và bỏ wget:
```bash
# !/bin/bash

# install CUDA Toolkit v9.0
# instructions from https://developer.nvidia.com/cuda-downloads (linux -> x86_64 -> Ubuntu -> 16.04 -> deb)
CUDA_REPO_PKG="cuda-repo-ubuntu1604-9-0-local_9.0.176-1_amd64-deb"
wget https://developer.nvidia.com/compute/cuda/9.0/Prod/local_installers/${CUDA_REPO_PKG}
sudo dpkg -i ${CUDA_REPO_PKG}
sudo apt-key adv --fetch-keys http://developer.download.nvidia.com/compute/cuda/repos/ubuntu1604/x86_64/7fa2af80.pub
sudo apt-get update
sudo apt-get -y install cuda-9-0

CUDA_PATCH1="cuda-repo-ubuntu1604-9-0-local-cublas-performance-update_1.0-1_amd64-deb"
wget https://developer.nvidia.com/compute/cuda/9.0/Prod/patches/1/${CUDA_PATCH1}
sudo dpkg -i ${CUDA_PATCH1}
sudo apt-get update

# install cuDNN v7.0
CUDNN_PKG="libcudnn7_7.0.5.15-1+cuda9.0_amd64.deb"
wget https://github.com/ashokpant/cudnn_archive/raw/master/v7.0/${CUDNN_PKG}
sudo dpkg -i ${CUDNN_PKG}
sudo apt-get update

# install NVIDIA CUDA Profile Tools Interface ( libcupti-dev v9.0)
sudo apt-get install cuda-command-line-tools-9-0

# set environment variables
export PATH=${PATH}:/usr/local/cuda-9.0/bin
export CUDA_HOME=${CUDA_HOME}:/usr/local/cuda:/usr/local/cuda-9.0
export LD_LIBRARY_PATH=${LD_LIBRARY_PATH}:/usr/local/cuda-9.0/lib64
export LD_LIBRARY_PATH=$LD_LIBRARY_PATH:/usr/local/cuda/extras/CUPTI/lib64
```



## Tham khảo các hướng dẫn bên ngoài
- Link chính thức [hướng dẫn cài driver & cuda](https://docs.nvidia.com/cuda/cuda-toolkit-release-notes/index.html)
- Tham khảo bản này: cho Ubuntu: [tại đây](https://medium.com/codezillas/step-by-step-guide-to-install-tensorflow-gpu-on-ubuntu-18-04-lts-6feceb0df5c0)
- [How to verify CuDNN installation?](https://stackoverflow.com/questions/31326015/how-to-verify-cudnn-installation/36978616#36978616)

        The installation of CuDNN is just copying some files. Hence to check if CuDNN is installed (and which version you have), you only need to check those files.

        Install CuDNN
        Step 1: Register an nvidia developer account and [download](https://developer.nvidia.com/cudnn) cudnn here (about 80 MB). You might need `nvcc --version` to get your cuda version.

        Step 2: Check where your cuda installation is. For most people, it will be `/usr/local/cuda/`. You can check it with `which nvcc`.

        Step 3: Copy the files:

        $ cd folder/extracted/contents
        $ sudo cp include/cudnn.h /usr/local/cuda/include
        $ sudo cp lib64/libcudnn* /usr/local/cuda/lib64
        $ sudo chmod a+r /usr/local/cuda/lib64/libcudnn*

        Check version
        You might have to adjust the path. See step 2 of the installation.

        $ cat /usr/local/cuda/include/cudnn.h | grep CUDNN_MAJOR -A 2
        Notes
        When you get an error like

        F tensorflow/stream_executor/cuda/cuda_dnn.cc:427] could not set cudnn filter descriptor: CUDNN_STATUS_BAD_PARAM
        with TensorFlow, you might consider using CuDNN v4 instead of v5.

        Ubuntu users who installed it via apt: [here](https://askubuntu.com/a/767270/10425)


## Cài driver kiểu dễ ăn

### Cài driver
- Tại máy trạm có thể truy cập vào máy chủ theo cách: `ssh -Y u@10.1.53.1`

- Mở windows `software & Update`  hay `driver & software` lên:
```bash
sudo software-properties-gtk
```

- uninstall driver cũ nếu như đã cài rồi (trong cửa sổ trên không cho chọn cài cái khác):
```bash
/usr/bin/nvidia-uninstall
```
Cài trên này thì được driver ổn định, nhưng không phải là mới nhất.
- Reboot!

### Cài CUDA

Cái này phải phù hợp với driver version


## Để cài driver mới nhất:

### Cài dạng manual.

- Download file cài về
- cài gcc, nếu không phải là ver > 7.2.0:
```bash
u@ubu:~$ gcc-7 -v
Using built-in specs.
COLLECT_GCC=gcc-7
COLLECT_LTO_WRAPPER=/usr/lib/gcc/x86_64-linux-gnu/7/lto-wrapper
OFFLOAD_TARGET_NAMES=nvptx-none
OFFLOAD_TARGET_DEFAULT=1
Target: x86_64-linux-gnu
Configured with: ../src/configure -v --with-pkgversion='Ubuntu 7.2.0-8ubuntu3.2' --with-bugurl=file:///usr/share/doc/gcc-7/README.Bugs --enable-languages=c,ada,c++,go,brig,d,fortran,objc,obj-c++ --prefix=/usr --with-gcc-major-version-only --program-suffix=-7 --program-prefix=x86_64-linux-gnu- --enable-shared --enable-linker-build-id --libexecdir=/usr/lib --without-included-gettext --enable-threads=posix --libdir=/usr/lib --enable-nls --with-sysroot=/ --enable-clocale=gnu --enable-libstdcxx-debug --enable-libstdcxx-time=yes --with-default-libstdcxx-abi=new --enable-gnu-unique-object --disable-vtable-verify --enable-libmpx --enable-plugin --enable-default-pie --with-system-zlib --with-target-system-zlib --enable-objc-gc=auto --enable-multiarch --disable-werror --with-arch-32=i686 --with-abi=m64 --with-multilib-list=m32,m64,mx32 --enable-multilib --with-tune=generic --enable-offload-targets=nvptx-none --without-cuda-driver --enable-checking=release --build=x86_64-linux-gnu --host=x86_64-linux-gnu --target=x86_64-linux-gnu
Thread model: posix
gcc version 7.2.0 (Ubuntu 7.2.0-8ubuntu3.2)
```

### Cách cài:

Xem bản gốc [tại đây](https://askubuntu.com/questions/26498/how-to-choose-the-default-gcc-and-g-version) và [tại đây](https://askubuntu.com/questions/949473/installing-gcc-7-2-via-apt)
1. Remove:

    ```bash
    sudo update-alternatives --remove-all gcc
    sudo update-alternatives --remove-all g++   
    ```

2. Install:
    ```bash
    sudo env DEBIAN_FRONTEND=noninteractive                                    \
         bash -c 'apt-get install -y python-software-properties lsb-release && \
                echo -e "Package: gcc-7\\nPin: release n=$(lsb_release -sc)\\nPin-Priority: 990" > /etc/apt/preferences.d/gcc-7 \
                apt-add-repository -yu ppa:ubuntu-toolchain-r/test &&              \
                apt-get install -y gcc-7'
    ```
3. Set Alternative:
    ```bash
    sudo update-alternatives --install /usr/bin/gcc gcc /usr/bin/gcc-7.2 10
    sudo update-alternatives --install /usr/bin/g++ g++ /usr/bin/g++-7.2 10
    sudo update-alternatives --config gcc
    sudo update-alternatives --config g++        
    ```


## Install gcc 4.8:
cái này dùng để biên dịch Yolo3

```bash
sudo apt-get install gcc-4.8
sudo apt-get install g++-4.8
sudo update-alternatives --install /usr/bin/gcc gcc /usr/bin/gcc-4.8 50
sudo update-alternatives --install /usr/bin/g++ g++ /usr/bin/g++-4.8 50
```    

#Virtual Environment
cái này nhanh hơn anaconda:

```bash
# Install virtual environment
sudo pip3 install virtualenv virtualenvwrapper
echo "# Virtual Environment Wrapper"  >> ~/.bashrc
echo "source /usr/local/bin/virtualenvwrapper.sh" >> ~/.bashrc
source ~/.bashrc

############ For Python 3 ############
# create virtual environment
mkvirtualenv P3 -p python3
workon P3

# now install python libraries within this virtual environment
pip install numpy scipy matplotlib scikit-image scikit-learn ipython

# quit virtual environment
deactivate
######################################
```




- Cài  NVIDIA DRIVER 390.77:

Tham khảo [tại đây](https://www.elinuxtutorials.com/2018/07/install-nvidia-driver-390-77-on-ubuntu-linuxmint/)

### INSTALL VIA SOURCE FILE

```
    1. Remove older version of NVIDIA if your graphic is supported
    sudo apt-get purge nvidia*

    2. Reboot the system

    3. Download the Nvidia Driver 390.77
    wget http://us.download.nvidia.com/XFree86/Linux-x86_64/390.77/NVIDIA-Linux-x86_64-390.77.run

    or: https://www.nvidia.com/object/unix.html

    4. Switch to command prompt and stop the running Graphics session
    sudo service lightdm stop
    sudo service gdm stop

    5. Give execute permissions to the installer
    sudo chmod 755 NVIDIA-Linux-x86_64-390.77.run

    6.Install the Nvidia 390.77 driver
    sudo ./NVIDIA-Linux-x86_64-390.77.run
```

# Remove Cuda toolkit

```bash
cd /usr/local/cuda-9.0/bin
sudo ./uninstall_cuda_9.0.pl

sudo rm -rd /usr/local/cuda-9.0

sudo apt-get remove nvidia-cuda-toolkit

```

Purging config/data

`sudo apt-get purge nvidia-cuda-toolkit` or

`sudo apt-get purge --auto-remove nvidia-cuda-toolkit`

Additionally, delete the `/opt/cuda` and `~/NVIDIA_GPU_Computing_SDK` folders if they are present. and remove the export `PATH=$PATH:/opt/cuda/bin` and `export LD_LIBRARY_PATH=$LD_LIBRARY_PATH:/opt/cuda/lib:/opt/cuda/lib64` lines of the `~/.bash_profile` file [1]

[1]: https://askubuntu.com/questions/530043/removing-nvidia-cuda-toolkit-and-installing-new-one "Removing nvidia cuda toolkit and installing new one"


# Install CUDA 9.0 and cuDNN 7.0 for TensorFlow/PyTorch (GPU) on Ubuntu 16.04: [here](https://medium.com/@zhanwenchen/install-cuda-and-cudnn-for-tensorflow-gpu-on-ubuntu-79306e4ac04e)

# Install CUDA 9.2 and cuDNN 7.1 for PyTorch (GPU) on Ubuntu 16.04: [here](https://medium.com/@zhanwenchen/install-cuda-9-2-and-cudnn-7-1-for-tensorflow-pytorch-gpu-on-ubuntu-16-04-1822ab4b2421)

## 1. Install NVIDIA Driver Version 396 via apt-get

```bash
sudo add-apt-repository ppa:graphics-drivers/ppa
sudo apt-get update
sudo apt-get install nvidia-396 nvidia-modprobe
```
You may be prompted to disable Secure Boot. If so, select __Disable__. Then reboot your machine but __enter BIOS to disable Secure Boot__. Typically you can enter BIOS by hitting F12 rapidly as soon as the system restarts.

To verify installation, restart your machine with reboot and type `nvidia-smi`.

## 2. Install CUDA 9.2 via Runfile

The CUDA runfile installer can be downloaded from [NVIDIA’s website](https://developer.nvidia.com/cuda-downloads). Choose the runfile option.

What you download is a package the following three components:

- an NVIDIA driver installer, but usually of stale version;
- the actual CUDA installer;
- the CUDA samples installer;

I suggest extracting the above three components and executing 2 and 3 separately (remember we installed the driver ourselves already). To extract them, execute the runfile installer with `--extract` option:

```bash
chmod +x cuda_9.2.148_396.37_linux-run
./cuda_9.2.148_396.37_linux-run --extract=$HOME
```

You should have unpacked three components: `NVIDIA-Linux-x86_64-396.37.run` (1. NVIDIA driver that we ignore), `cuda-linux.9.2.148-24330188.run` (2. CUDA 9.2 installer), and `cuda-samples.9.2.148-24330188-linux.run` (3. CUDA 9.2 Samples).

Execute the second one to install the CUDA Toolkit 9.2:

```bash
$ sudo ./cuda-linux.9.2.148-24330188.run
```
You now have to accept the license by scrolling down to the bottom (hold the “d” key or `Ctr_C` on your keyboard) and enter `“accept”`. Next accept the defaults.

To verify our CUDA installation, install the sample tests by

```bash
sudo ./cuda-samples.9.2.148-24330188-linux.run
```

After the installation finishes, you must configure the runtime library.

```bash
sudo bash -c "echo /usr/local/cuda/lib64/ > /etc/ld.so.conf.d/cuda.conf"
sudo ldconfig
```

It is also recommended for Ubuntu users to append string `/usr/local/cuda/bin` to system file `/etc/environment` so that `nvcc` will be included in `$PATH`. This will take effect after reboot. To do that, you just have to

```bash
$ sudo vim /etc/environment

export PATH=$PATH:/usr/local/cuda/bin
export LD_LIBRARY_PATH=/usr/local/cuda/lib64/
```

After a reboot, let's test our installation by making and invoking our tests:


```bash
$ cd /usr/local/cuda-9.2/samples
$ sudo make
```
It’s a long process with many irrelevant warnings about deprecated architectures (`sm_20` and such ancient GPUs). After it completes, run `deviceQuery` and `p2pBandwidthLatencyTest`:

```bash
$ cd /usr/local/cuda-9.2/samples/bin/x86_64/linux/release
$ ./deviceQuery

./deviceQuery Starting...
CUDA Device Query (Runtime API) version (CUDART static linking)
Detected 1 CUDA Capable device(s)
....
deviceQuery, CUDA Driver = CUDART, CUDA Driver Version = 9.2, CUDA Runtime Version = 9.2, NumDevs = 1
Result = PASS
```
Cleanup: if `./deviceQuery` works, remember to `rm` the 4 files (1 downloaded and 3 extracted).

## 3. Install cuDNN 7.1
The recommended way to install cuDNN 7.1 is to download all 3 .deb files. The .tgz installation approach doesn’t allow verification by running code samples (no way to install the code samples .deb after .tgz installation).

The following steps are pretty much the same as the installation guide using .deb files (strange that the cuDNN guide is better than the CUDA one).

- Go to the cuDNN download page (need registration) and select the latest cuDNN 7.1 version made for CUDA 9.2.
- Download all 3 .deb files: the runtime library, the developer library, and the code samples library for Ubuntu 16.04.
- In your download folder, install them in the same order:

    `sudo dpkg -i libcudnn7_7.1.4.18–1+cuda9.2_amd64.deb` (the runtime library),

    `sudo dpkg -i libcudnn7-dev_7.1.4.18–1+cuda9.2_amd64.deb` (the developer library), and

    `sudo dpkg -i libcudnn7-doc_7.1.4.18–1+cuda9.2_amd64.deb` (the code samples).

Now we can verify the cuDNN installation (below is just the official guide, which surprisingly works out of the box):

- Copy the code samples somewhere you have write access: `cp -r /usr/src/cudnn_samples_v7/ ~`.
- Go to the MNIST example code: `cd ~/cudnn_samples_v7/mnistCUDNN`.
- Compile the MNIST example: `make clean && make`.
- Run the MNIST example: `./mnistCUDNN`. If your installation is successful, you should see `Test passed!` at the end of the output.

## Do NOT Install cuda-command-line-tools
Contrary to the official TensorFlow installation docs, you don’t need to install `cuda-command-line-tools` because it’s already installed in this version of CUDA and cuDNN. If you` apt-get` it, you won’t find it.

## Configure the CUDA and cuDNN library paths
What you do need to do, however, is exporting environment variables `LD_LIBRARY_PATH` in your `.bashrc` file:

```bash
# put the following line in the end or your .bashrc file
export LD_LIBRARY_PATH=$LD_LIBRARY_PATH:/usr/local/cuda/extras/CUPTI/lib64
```

And source it by `source ~/.bashrc`.



.
